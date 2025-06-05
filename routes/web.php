<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CaseNoteController;
use App\Http\Controllers\CaseNoteCommentController;
use App\Http\Controllers\CaseNoteFileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AppointmentCategoryController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\QueueStatusController;
use App\Http\Controllers\QueueOutsidePrescriptionController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderProductController;
use App\Http\Controllers\PurchaseOrderFileController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PatientCreditController;
use App\Http\Controllers\AccountingReportController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\UOMController;
use App\Http\Controllers\UsageController;
use App\Http\Controllers\DosageController;
use App\Http\Controllers\FrequencyController;
use App\Http\Controllers\AppointmentStatusController;
use App\Http\Controllers\CaseTypeController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\CaseNoteTemplateController;
use App\Http\Controllers\InventoryReportController;
use App\Http\Controllers\PatientReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/linkstorage', function () { $targetFolder = base_path().'/storage/app/public'; $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage'; symlink($targetFolder, $linkFolder); });

Auth::routes();

Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404, 'File not found.');
    }

    return response()->file($path, [
        'Cache-Control' => 'no-cache, must-revalidate',
        'Expires' => '0',
    ]);
})->where('filename', '.*');

Route::middleware(['auth'])->group(function () {
    Route::redirect('/', 'patients');

    Route::middleware('checkPermission:Patient')->group(function () {
        Route::resource('/patients', PatientController::class)->except(['create'])->middleware('checkPermission:Patient');
        Route::put('/patients/{patientId}/case-notes/{id}/revert', [CaseNoteController::class, 'revert'])->name('case-notes.revert');
        Route::resource('/patients/{patientId}/case-notes', CaseNoteController::class)->except(['create']);
        Route::resource('/case-notes/{caseNoteId}/comments', CaseNoteCommentController::class)->except(['create', 'edit', 'update', 'show']);
        Route::resource('/case-notes/{caseNoteId}/attachments', CaseNoteFileController::class)->except(['create', 'edit', 'update', 'show']);
        Route::get('/case-note-files/{name}', [CaseNoteFileController::class, 'download'])->name('case-note-files.download');
        Route::post('/case-note-files/{id}/upload', [CaseNoteFileController::class, 'upload'])->name('case-note-files.upload');
        Route::resource('/patients/{patientId}/credits', PatientCreditController::class)->only(['index', 'store', 'destroy']);
        Route::get('/patients/{patientId}/visits', [PatientController::class, 'visits'])->name('patients.visits');
        Route::get('/patients/{patientId}/label', [PatientController::class, 'label'])->name('patients.label');
        Route::get('/case-note-templates/{id}/description', [CaseNoteTemplateController::class, 'getDescription'])->name('case-note-templates.description');
    });

    Route::middleware('checkPermission:Appointment')->group(function () {
        Route::get('/appointment-categories/calendar', [AppointmentCategoryController::class, 'calendar'])->name('appointment-categories.calendar');
        Route::put('/appointment/{id}/update-status/{isConfirmed}', [AppointmentController::class, 'updateStatus'])->name('appointment.update-status');
        Route::put('/appointment/{id}/update-schedule', [AppointmentController::class, 'updateSchedule'])->name('appointment.update-schedule');
        Route::post('/appointment/{id}/create-patient', [AppointmentController::class, 'createPatient'])->name('appointment.create-patient');
        Route::get('/appointment/calendar', [AppointmentController::class, 'calendar'])->name('appointment.calendar');
        Route::resource('/appointment', AppointmentController::class)->except(['create']);
    });

    Route::middleware('checkPermission:Queue')->group(function () {
        Route::get('/queue-statuses', [QueueStatusController::class, 'index'])->name('queue-statuses.index');
        Route::get('/queue/{id}/invoice', [QueueController::class, 'invoice'])->name('queue.invoice');
        Route::get('/queue/{id}/item-label/edit', [QueueController::class, 'editItemLabel'])->name('queue.edit-item-label');
        Route::put('/queue/{id}/item-label/update', [QueueController::class, 'updateItemLabel'])->name('queue.update-item-label');
        Route::get('/queue/{id}/item-label', [QueueController::class, 'itemLabel'])->name('queue.item-label');
        Route::put('/queue/{id}/update-status/{statusId}', [QueueController::class, 'updateStatus'])->name('queue.update-status');
        Route::put('/queue/{id}/void', [QueueController::class, 'void'])->name('queue.void');
        Route::put('/queue/{id}/update-notes', [QueueController::class, 'updateNotes'])->name('queue.update-notes');
        Route::put('/queue/{id}/update-time-in', [QueueController::class, 'updateTimeIn'])->name('queue.update-time-in');
        Route::put('/queue/{id}/update-time-out', [QueueController::class, 'updateTimeOut'])->name('queue.update-time-out');
        Route::get('/queue/session-balances/{patientId}', [QueueController::class, 'getSessionBalances'])->name('queue.session-balances');
        Route::get('/queue/session-balance-logs/{sbId}', [QueueController::class, 'getSessionBalanceLogs'])->name('queue.session-balance-logs');
        Route::get('/queue/items', [QueueController::class, 'getItems'])->name('queue.items');
        Route::resource('/queue', QueueController::class)->except(['create', 'show']);
        Route::put('/queue/{queueId}/outside-prescriptions/{id}/revert', [QueueOutsidePrescriptionController::class, 'revert'])->name('queue-outside-prescriptions.revert');
        Route::get('/queue/{queueId}/outside-prescriptions/{id}/print', [QueueOutsidePrescriptionController::class, 'print'])->name('queue-outside-prescriptions.print');
        Route::resource('/queue/{queueId}/outside-prescriptions', QueueOutsidePrescriptionController::class)->except(['create', 'show']);
    });

    Route::prefix('inventory-setup')->group(function () {
        Route::resource('/inventory', InventoryController::class)->except(['create'])->middleware('checkPermission:Inventory');
        Route::resource('/packages', PackageController::class)->except(['create'])->middleware('checkPermission:Package');
        Route::resource('/suppliers', SupplierController::class)->except(['create'])->middleware('checkPermission:Supplier');
    });

    Route::prefix('stock-management')->group(function () {
        Route::middleware('checkPermission:Purchase Order')->group(function () {
            Route::resource('/purchase-orders', PurchaseOrderController::class)->except(['create']);
            Route::post('/purchase-orders/{id}/update-payment', [PurchaseOrderController::class, 'updatePayment'])->name('purchase-orders.update-payment');
            Route::resource('/purchase-orders/{orderId}/products', PurchaseOrderProductController::class)->only(['show', 'update']);
            Route::resource('/purchase-orders/{orderId}/files', PurchaseOrderFileController::class)->only(['index', 'destroy']);
            Route::get('/purchase-orders/{orderId}/files/download/{name}', [PurchaseOrderFileController::class, 'download'])->name('purchase-order-files.download');
            Route::post('/purchase-orders/{orderId}/files/upload', [PurchaseOrderFileController::class, 'upload'])->name('purchase-order-files.upload');
        });

        Route::resource('/stock-adjustments', StockAdjustmentController::class)->except(['create', 'edit', 'update'])->middleware('checkPermission:Stock Adjustment');
    });

    Route::prefix('reports')->group(function () {
        Route::middleware('checkPermission:Accounting Report')->group(function () {
            Route::get('/accounting-reports', [AccountingReportController::class, 'index'])->name('accounting-reports.index');
            Route::get('/accounting-reports/transaction-summary', [AccountingReportController::class, 'transactionSummary'])->name('accounting-reports.transaction-summary');
            Route::post('/accounting-reports/transaction-summary-data', [AccountingReportController::class, 'transactionSummaryData'])->name('accounting-reports.transaction-summary-data');
            Route::post('/accounting-reports/voided-transaction-data', [AccountingReportController::class, 'voidedTransactionData'])->name('accounting-reports.voided-transaction-data');
            Route::post('/accounting-reports/transaction-summary-payment-mode-data', [AccountingReportController::class, 'transactionSummaryPaymentModeData'])->name('accounting-reports.transaction-summary-payment-mode-data');
            Route::get('/accounting-reports/owing-transaction', [AccountingReportController::class, 'owingTransaction'])->name('accounting-reports.owing-transaction');
            Route::post('/accounting-reports/owing-transaction-data', [AccountingReportController::class, 'owingTransactionData'])->name('accounting-reports.owing-transaction-data');
            Route::get('/accounting-reports/detailed-billing-summary', [AccountingReportController::class, 'detailedBillingSummary'])->name('accounting-reports.detailed-billing-summary');
            Route::post('/accounting-reports/detailed-billing-summary-data', [AccountingReportController::class, 'detailedBillingSummaryData'])->name('accounting-reports.detailed-billing-summary-data');
        });

        Route::middleware('checkPermission:Inventory Report')->group(function () {
            Route::get('/inventory-reports', [InventoryReportController::class, 'index'])->name('inventory-reports.index');
            Route::get('/inventory-reports/purchase-delivery', [InventoryReportController::class, 'purchaseDelivery'])->name('inventory-reports.purchase-delivery');
            Route::post('/inventory-reports/purchase-delivery-data', [InventoryReportController::class, 'purchaseDeliveryData'])->name('inventory-reports.purchase-delivery-data');
            Route::get('/inventory-reports/item-dispensed', [InventoryReportController::class, 'itemDispensed'])->name('inventory-reports.item-dispensed');
            Route::post('/inventory-reports/item-dispensed-data', [InventoryReportController::class, 'itemDispensedData'])->name('inventory-reports.item-dispensed-data');
            Route::get('/inventory-reports/stock-adjustment', [InventoryReportController::class, 'stockAdjustment'])->name('inventory-reports.stock-adjustment');
            Route::post('/inventory-reports/stock-adjustment-data', [InventoryReportController::class, 'stockAdjustmentData'])->name('inventory-reports.stock-adjustment-data');
            Route::get('/inventory-reports/drug-usage-product', [InventoryReportController::class, 'drugUsageProduct'])->name('inventory-reports.drug-usage-product');
            Route::post('/inventory-reports/drug-usage-product-data', [InventoryReportController::class, 'drugUsageProductData'])->name('inventory-reports.drug-usage-product-data');
            Route::get('/inventory-reports/drug-usage-package', [InventoryReportController::class, 'drugUsagePackage'])->name('inventory-reports.drug-usage-package');
            Route::post('/inventory-reports/drug-usage-package-data', [InventoryReportController::class, 'drugUsagePackageData'])->name('inventory-reports.drug-usage-package-data');
        });

        Route::middleware('checkPermission:Patient Report')->group(function () {
            Route::get('/patient-reports', [PatientReportController::class, 'index'])->name('patient-reports.index');
            Route::get('/patient-reports/detailed-patient-history', [PatientReportController::class, 'detailedPatientHistory'])->name('patient-reports.detailed-patient-history');
            Route::post('/patient-reports/detailed-patient-history-data', [PatientReportController::class, 'detailedPatientHistoryData'])->name('patient-reports.detailed-patient-history-data');
        });
    });

    Route::prefix('general-setup')->group(function () {
        Route::middleware('checkPermission:Access Control Setup')->group(function () {
            Route::get('/access-control', [AccessControlController::class, 'index'])->name('access-control.index');
            Route::resource('/users', UserController::class)->except(['create']);
            Route::resource('/roles', RoleController::class)->except(['create', 'show']);
        });

        Route::resource('/branches', BranchController::class)->except(['create'])->middleware('checkPermission:Branch Setup');

        Route::middleware('checkPermission:Patient Setup')->group(function () {
            Route::get('/patient', [PatientController::class, 'generalSetupIndex'])->name('patient-general-setup.index');
            Route::resource('/case-types', CaseTypeController::class)->except(['create', 'show']);
            Route::resource('/case-note-templates', CaseNoteTemplateController::class)->except(['create', 'show']);
            Route::resource('/titles', TitleController::class)->except(['create', 'show']);
        });

        Route::middleware('checkPermission:Appointment Setup')->group(function () {
            Route::get('/appointment', [AppointmentController::class, 'generalSetupIndex'])->name('appointment-general-setup.index');
            Route::resource('/appointment-categories', AppointmentCategoryController::class)->except(['create', 'show']);
            Route::resource('/appointment-statuses', AppointmentStatusController::class)->except(['create', 'show']);
        });

        Route::middleware('checkPermission:Inventory Setup')->group(function () {
            Route::get('/inventory', [InventoryController::class, 'generalSetupIndex'])->name('inventory-general-setup.index');
            Route::resource('/product-types', ProductTypeController::class)->except(['create', 'show']);
            Route::resource('/product-categories', ProductCategoryController::class)->except(['create', 'show']);
            Route::resource('/uoms', UOMController::class)->except(['create', 'show']);
            Route::resource('/usages', UsageController::class)->except(['create', 'show']);
            Route::resource('/dosages', DosageController::class)->except(['create', 'show']);
            Route::resource('/frequencies', FrequencyController::class)->except(['create', 'show']);
        });

        Route::middleware('checkPermission:Finance Setup')->group(function () {
            Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
            Route::resource('/taxes', TaxController::class)->except(['create', 'show']);
            Route::resource('/payment-modes', PaymentModeController::class)->except(['create', 'show']);
        });
    });

    Route::get('/branches/{id}/switch', [BranchController::class, 'switch'])->name('branches.switch');
    Route::get('/states/{id}/cities', [StateController::class, 'getCities'])->name('states.cities');
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::put('/change-password', [UserController::class, 'updatePassword'])->name('users.update-password');
});
