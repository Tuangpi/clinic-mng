<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\Uom;
use App\Models\Supplier;
use App\Models\Usage;
use App\Models\Dosage;
use App\Models\Frequency;

use DataTables;

class InventoryController extends Controller
{
    public function generalSetupIndex()
    {
        return view('general-setup/inventory');
    }
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
            $data = Product::active($branchId, $request->type, $request->category, $request->critical);

            return Datatables::of($data)
                ->filterColumn('uom', function ($query, $keyword) {
                    $query->whereRaw("u.description like ?", ["%{$keyword}%"]);
                })
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
        $uoms = Uom::forDropdown()->get();
        $usages = Usage::forDropdown()->get();
        $dosages = Dosage::forDropdown()->get();
        $frequencies = Frequency::forDropdown()->get();
        $suppliers = Supplier::forDropdown(true)->get();
        $manufacturers = Supplier::forDropdown(false)->get();
        return view('inventory-setup/inventory', compact('types', 'categories', 'uoms', 'usages', 'dosages', 'frequencies', 'suppliers', 'manufacturers'));
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
            if ($request->code && Product::where([['code2', $request->code], ['branch_id', $currentBranch->id]])->exists()) {
                return response()->json(['errMsg' => 'Code already exists', 'isError' => true]);
            }

            $currentUserId = \Auth::id();
            \DB::beginTransaction();

            $p = new Product;
            $p->branch_id = $currentBranch->id;
            $p->created_by = $currentUserId;
            $p->updated_by = $currentUserId;
            $p->current_stock = 0;
            $this->mapValues($p, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New item has been created.']);
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
            $p = Product::with([
                'productType:id,description',
                'productCategory:id,description',
                'uom:id,description',
                'usage:id,description',
                'dosage:id,description',
                'dosageUom:id,description',
                'frequency:id,description',
                'supplier:id,name',
                'manufacturer:id,name',
                'creator:id,first_name,last_name',
                'updator:id,first_name,last_name'
            ])->find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['product' => $p]);
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
            $p = Product::find($id);
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json(['product' => $p]);
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

            $p = Product::find($id);

            if ($request->code && Product::where([
                ['code2', $request->code],
                ['branch_id', $p->branch_id],
                ['id', '<>', $id]
            ])->exists()) {
                return response()->json(['errMsg' => 'Code already exists', 'isError' => true]);
            }

            $p->updated_by = \Auth::id();
            $this->mapValues($p, $request);

            $p->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Product has been updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Product::find($id);

        if ($p->packageProducts()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this item is used in a package.', 'isError' => true]);
        } else if ($p->transactions()->exists()) {
            return response()->json(['errMsg' => 'Unable to delete, this item is used in a transaction.', 'isError' => true]);
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
        $p->uom_id = $request->uom;
        $p->description = $request->description;
        $p->selling_price = $request->sellingPrice;
        $p->cost_price = $request->costPrice;
        $p->has_dosage = $request->hasDosage;
        $p->supplier_id = $request->supplier;
        $p->manufacturer_id = $request->manufacturer;
        $p->critical_level = $request->criticalLevel;
        $p->is_stock_unlimited = $request->isStockUnlimited;
        $p->is_active = $request->status;

        if ($p->has_dosage) {
            $p->usage_id = $request->usage;
            $p->dosage_id = $request->dosage;
            $p->dosage_uom_id = $request->unit;
            $p->frequency_id = $request->frequency;
            $p->total_dosage = $request->totalDosage;
        } else {
            $p->usage_id = null;
            $p->dosage_id = null;
            $p->dosage_uom_id = null;
            $p->frequency_id = null;
            $p->total_dosage = null;
        }

        $p->save();

        $p->code = 'PR-' . sprintf('%02d', $p->branch_id) . '-' . sprintf('%05d', $p->id) . '-' . $p->code2;

        $p->photo_ext = $request->photoExt;
        if (!empty($request->photo)) {
            $image = base64_decode($request->photo);
            \Storage::disk('public')->put('product-image/' . $p->id . '.' . $request->photoExt, $image);
        }

        $p->save();
    }
}
