<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\QueueTransaction;
use App\Models\QueueTransactionProduct;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\StockAdjustmentType;
use App\Models\StockAdjustmentProduct;
use App\Models\Patient;

use DataTables;

class InventoryReportController extends Controller
{
    public function index()
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;

        $suppliers = Supplier::forDropdown(true)->get();
        $products = Product::forDropdown($branchId)->get();
        $types = ProductType::forDropdown()->get();
        $categories = ProductCategory::forDropdown()->get();
        $adjustmentTypes = StockAdjustmentType::forDropdown()->get();
        $patients = Patient::forDropdown()->get();

        return view('reports.inventory-reports', compact('suppliers', 'products', 'types', 'categories', 'adjustmentTypes', 'patients')); 
    }
    
    public function purchaseDelivery(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.inventory-reports.purchase-delivery', compact('startDate', 'endDate', 'branch')); 
    }
    
    public function purchaseDeliveryData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $data = PurchaseOrder::deliveryReport($branchId, $request->startDate, $request->endDate, $request->supplier, $request->deliveryStatus);
        
        return Datatables::of($data)
        ->make(true);
    }
    
    public function itemDispensed(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.inventory-reports.item-dispensed', compact('startDate', 'endDate', 'branch')); 
    }
    
    public function itemDispensedData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $data = QueueTransaction::itemDispensedReport($branchId, $request->product, $request->startDate, $request->endDate, $request->category, $request->type)
                ->union(
                    QueueTransactionProduct::itemDispensedReport($branchId, $request->product, $request->startDate, $request->endDate, $request->category, $request->type)
                );
        
        return Datatables::of($data)
        ->make(true);
    }
    
    public function stockAdjustment(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.inventory-reports.stock-adjustment', compact('startDate', 'endDate', 'branch')); 
    }
    
    public function stockAdjustmentData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $data = StockAdjustmentProduct::stockAdjustmentReport($branchId, $request->product, $request->startDate, $request->endDate, $request->type);
        
        return Datatables::of($data)
        ->make(true);
    }
    
    public function drugUsageProduct(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.inventory-reports.drug-usage-product', compact('startDate', 'endDate', 'branch')); 
    }
    
    public function drugUsageProductData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $data = QueueTransaction::drugUsageProductReport($branchId, $request->startDate, $request->endDate, $request->patient);
        
        return Datatables::of($data)
        ->make(true);
    }
    
    public function drugUsagePackage(Request $request)
    {
        $branch = session('branch');
        if (!$branch) {
            $branch = \Auth::user()->branches->first();
        }
        $startDate = \Carbon::parse($request->startDate)->format('d M y');
        $endDate = \Carbon::parse($request->endDate)->format('d M y');
        return view('partials.reports.inventory-reports.drug-usage-package', compact('startDate', 'endDate', 'branch')); 
    }
    
    public function drugUsagePackageData(Request $request)
    {
        $currentBranch = session('branch');
        $branchId = $currentBranch ? $currentBranch->id : null;
        $data = QueueTransaction::drugUsagePackageReport($branchId, $request->startDate, $request->endDate, $request->patient);
        
        return Datatables::of($data)
        ->make(true);
    }
}
