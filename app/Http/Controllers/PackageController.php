<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\PackageProduct;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductCategory;

use DataTables;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        if ($request->ajax()) {
            $data = Package::active($branchId, $request->type, $request->category);

            return Datatables::of($data)
                ->filterColumn('type', function ($query, $keyword) {
                    $query->whereRaw("t.description like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('category', function ($query, $keyword) {
                    $query->whereRaw("c.description like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('branch', function ($query, $keyword) {
                    $query->whereRaw("b.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }

        $types = ProductType::forDropdown()->get();
        $categories = ProductCategory::forDropdown()->get();
        $products = Product::forDropdown($branchId)->get();
        return view('inventory-setup/packages', compact('types', 'categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $currentBranch = session('branch');
            if ($request->name && Product::where([['name', $request->name], ['branch_id', $currentBranch->id]])->exists()) {
                return response()->json(['errMsg' => 'Name already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $p = new Package;
            $p->branch_id = $currentBranch->id;
            $p->created_by = $currentUserId;
            $p->updated_by = $currentUserId;
            $this->mapValues($p, $request);

            $cost_price = 0;
            if (!empty($request->products)) {
                foreach ($request->products as $prod) {
                    $pp = new PackageProduct;
                    $pp->product_id = $prod['product'];
                    $pp->qty = $prod['qty'];
                    $pp->created_by = $currentUserId;
                    $pp->updated_by = $currentUserId;
                    $p->packageProducts()->save($pp);

                    $cost_price += (($pp->qty == null ? 1 : $pp->qty) * $pp->product->cost_price);
                }
            }
            $p->cost_price = $cost_price;
            $p->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New package has been created.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $p = Package::with([
                'productType:id,description',
                'productCategory:id,description',
                'packageProducts:id,package_id,product_id,qty',
                'packageProducts.product:id,name',
                'creator:id,first_name,last_name',
                'updator:id,first_name,last_name'
            ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['package' => $p]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $p = Package::with(['packageProducts:id,package_id,product_id,qty'])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['package' => $p]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            \DB::beginTransaction();

            $p = Package::find($id);

            if ($request->name && Package::where([
                ['name', $request->name],
                ['branch_id', $p->branch_id],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Name already exists', 'isError' => true]);
            }

            $p->updated_by = \Auth::id();
            $this->mapValues($p, $request);

            $cost_price = 0;
            if (!empty($request->products)) {

                $pIds = collect($request->products)->pluck('id');
                $p->packageProducts()->whereNotIn('id', $pIds)->delete();

                foreach ($request->products as $prod) {
                    $newProduct = $prod['id'] == '0';

                    if ($newProduct) {
                        $pp = new PackageProduct;
                        $pp->created_by = \Auth::id();
                    } else {
                        $pp = PackageProduct::find($prod['id']);
                    }

                    $pp->product_id = $prod['product'];
                    $pp->qty = $prod['qty'];
                    $pp->updated_by = \Auth::id();
                    $p->packageProducts()->save($pp);

                    $cost_price += (($pp->qty == null ? 1 : $pp->qty) * $pp->product->cost_price);
                }
            } else {
                $p->packageProducts()->delete();
            }

            $p->cost_price = $cost_price;
            $p->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Package has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Package::find($id);

        if ($p->transactions()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this package is used in a transaction.', 'isError' => true]);
        }
        $p->forceDelete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    private function mapValues($p, $request)
    {
        $p->code2 = $request->code;
        $p->name = $request->name;
        $p->product_type_id = $request->type;
        $p->product_category_id = $request->category;
        $p->description = $request->description;
        $p->selling_price = $request->sellingPrice;
        $p->cost_price = $request->costPrice;
        $p->session_count = $request->sessionCount;
        $p->is_active = $request->status;

        $p->save();

        $p->code = 'PK-' . sprintf('%02d', $p->branch_id) . '-' . sprintf('%05d', $p->id) . '-' . $p->code2;

        $p->save();
    }
}
