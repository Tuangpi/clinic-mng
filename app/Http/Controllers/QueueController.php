<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Patient;
use App\Models\Queue;
use App\Models\QueueTransaction;
use App\Models\QueuePayment;
use App\Models\QueueStatus;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductCategory;
use App\Models\PaymentOption;
use App\Models\Package;
use App\Models\IncompleteTransaction;
use App\Models\QueueTransactionProduct;
use App\Models\Uom;
use App\Models\Supplier;
use App\Models\Usage;
use App\Models\Dosage;
use App\Models\Frequency;
use App\Models\PatientAvailableCredit;
use App\Models\ViewQueueItem;

use DataTables;

class QueueController extends Controller
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
            $data = Queue::active($branchId, $request->date, $request->status);

            return Datatables::of($data)
                ->filterColumn('patient', function ($query, $keyword) {
                    $query->whereRaw("concat(p.code, ' - ', p.first_name, ' ', p.last_name) like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('status', function ($query, $keyword) {
                    $query->whereRaw("s.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }

        $patients = Patient::forDropdown()->get();
        $statuses = QueueStatus::forDropdown($branchId)->orderBy('seq_no')->get();
        $productTypes = ProductType::forDropdown()->get();
        $productCategories = ProductCategory::forDropdown()->get();
        $paymentOptions = PaymentOption::forDropdown($branchId)->get();

        $defaultDate = '';
        $defaultId = '';
        if ($request->id) {
            $q = Queue::find($request->id);
            $defaultDate = Carbon::parse($q->time_in)->todatestring();
            $defaultId = $q->id;
        }

        return view('queues', compact('currentBranch', 'patients', 'statuses', 'productTypes', 'productCategories', 'paymentOptions', 'defaultDate', 'defaultId'));
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
            \DB::beginTransaction();

            $q = new Queue;
            $q->branch_id = $currentBranch->id;
            $q->queue_status_id = QueueStatus::forDropdown($currentBranch->id)->orderBy('seq_no')->select('queue_statuses.id')->first()->id;
            $q->created_by = \Auth::id();
            $q->updated_by = \Auth::id();
            $this->mapValues($q, $request);

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'New queue has been created.']);
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
            $q = Queue::find($id);
            $sessionBalanceCount = IncompleteTransaction::forQueue($q->branch_id, $q->patient_id)->count();
            $transactions = QueueTransaction::with(['product:id,current_stock,is_stock_unlimited,uom_id', 'package:id,session_count'])->where('queue_id', $id)->get();
            foreach ($transactions as $trans) {
                if ($trans->package_id) {
                    $details = '';
                    if ($q->is_draft) {
                        if ($trans->incomplete_transaction_id) {
                            $details = $trans->parentIncompleteTransaction->queueTransaction->packageProducts->map(function ($pp) {
                                $prod = $pp->product ?? Product::withTrashed()->find($pp->product_id);
                                return ($pp->qty ? number_format($pp->qty, 2) . ' ' : '') . $pp->name . ($prod->is_stock_unlimited ? '' : ' (' . number_format($prod->current_stock, 2) . ')');
                            })->implode(', ') . ': ' . $trans->parentIncompleteTransaction->session_count . ' session' . ($trans->parentIncompleteTransaction->session_count > 1 ? 's' : '');
                        } else {
                            $p = Package::find($trans->package_id);
                            $trans->session_count = $p->session_count;
                            $details = $p->packageProducts->map(function ($pp) {
                                $prod = $pp->product ?? Product::withTrashed()->find($pp->product_id);
                                return ($pp->qty ? number_format($pp->qty, 2) . ' ' : '') . $prod->name . ($prod->is_stock_unlimited ? '' : ' (' . number_format($prod->current_stock, 2) . ')');
                            })->implode(', ') . ': ' . $p->session_count . ' session' . ($p->session_count > 1 ? 's' : '');
                        }
                    } else {
                        $details = $trans->packageProducts->map(function ($pp) {
                            $prod = $pp->product ?? Product::withTrashed()->find($pp->product_id);
                            return ($pp->qty ? number_format($pp->qty, 2) . ' ' : '') . $pp->name;
                        })->implode(', ') . ': ' . $trans->session_count . ' session' . ($trans->session_count > 1 ? 's' : '');
                    }
                    $trans->package_details = $details;
                    $trans->uom = '';
                } else {
                    $trans->package_details = '';
                    if ($trans->product_id) {
                        $prod = $trans->product ?? Product::withTrashed()->find($trans->product_id);
                        $trans->uom = $prod->uom->description;
                    }
                }
            }
            $payments = QueuePayment::with('paymentOption:id,description')->where('queue_id', $id)->get();

            $availableCredit = 0;
            $ac = PatientAvailableCredit::where([
                ['patient_id', $q->patient_id],
                ['branch_id', $q->branch_id],
            ])->first();
            if ($ac) {
                $availableCredit = $ac->amount;
            }
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json([
            'isDraft' => $q->is_draft,
            'currencySymbol' => $q->branch->currency_symbol,
            'notes' => $q->notes,
            'refNo' => $q->ref_no,
            'doctor' => $q->attending_doctor,
            'transactionRemarks' => $q->transaction_remarks,
            'includeInvoiceRemarks' => $q->include_invoice_remarks,
            'transactions' => $transactions,
            'payments' => $payments,
            'sessionBalanceCount' => $sessionBalanceCount,
            'foodAllergies' => $q->patient->food_allergies,
            'drugAllergies' => $q->patient->drug_allergies,
            'overallDiscPercentage' => $q->overall_disc_percentage,
            'overallDiscAmount' => $q->overall_disc_amount,
            'availableCredit' => $availableCredit,
            'pxCredit' => $q->px_credit,
            'preTotalAmount' => $q->pre_total_amount,
            'prePaidAmount' => $q->pre_paid_amount,
            'totalAmount' => $q->total_amount,
            'paidAmount' => $q->paid_amount,
            'totalAmountBeforePxCredit' => $q->total_amount_before_px_credit,
            'paidAmountBeforePxCredit' => $q->paid_amount_before_px_credit,
        ]);
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
            $userId = \Auth::id();

            $q = Queue::find($id);
            $q->updated_by = $userId;
            $isDraft = $q->is_draft;

            $q->notes = $request->notes;
            $q->ref_no = $request->refNo;
            $q->attending_doctor = $request->doctor;
            $q->transaction_remarks = $request->transactionRemarks;
            $q->include_invoice_remarks = $request->includeInvoiceRemarks;

            if ($isDraft) {
                $q->overall_disc_percentage = $request->overallDiscPercentage;
                $q->overall_disc_amount = $request->overallDiscAmount;
                $q->pre_total_amount = $request->preTotalAmount;
                $q->total_amount_before_px_credit = $request->totalAmountBeforePxCredit;
                $q->px_credit = $request->pxCredit;
                $q->total_amount = $request->totalAmount;
                $q->is_draft = $request->isDraft;

                if (!$q->is_draft) {
                    $q->pre_paid_amount = $request->prePaidAmount;
                    $q->paid_amount_before_px_credit = $request->paidAmountBeforePxCredit;
                    $q->paid_amount = $request->paidAmount;
                    $q->posted_date = Carbon::now();
                    if (!$q->time_out) {
                        $q->time_out = Carbon::now();
                    }

                    if ($q->px_credit) {
                        $ac = PatientAvailableCredit::where([
                            ['patient_id', $q->patient_id],
                            ['branch_id', $q->branch_id],
                        ])->first();
                        if ($ac) {
                            $ac->amount -= $q->px_credit;
                            $ac->save();
                        }
                    }
                }

                if (!empty($request->transactions)) {

                    $tIds = collect($request->transactions)->pluck('id');
                    $q->transactions()->whereNotIn('id', $tIds)->delete();

                    $overallDiscAmount = $q->overall_disc_amount;
                    $pxCredit = $q->px_credit;
                    foreach ($request->transactions as $trans) {
                        $newTrans = $trans['id'] == '0';

                        if ($newTrans) {
                            $t = new QueueTransaction;
                            $t->queue_id = $id;
                            $t->created_by = $userId;
                        } else {
                            $t = QueueTransaction::find($trans['id']);
                        }

                        $t->product_id = $trans['productId'];
                        $t->package_id = $trans['packageId'];
                        $t->incomplete_transaction_id = $trans['icId'];
                        $t->item_code = $trans['itemCode'];
                        $t->name = $trans['name'];
                        $t->unit_price = $trans['unitPrice'];
                        $t->qty = $trans['qty'];
                        $t->price = $trans['price'];
                        $t->total_amount = $trans['totalAmount'];
                        $t->disc_percentage = $trans['discPercentage'];
                        $t->disc_amount = $trans['discAmount'];
                        $t->sub_total = $trans['subTotal'];
                        $t->amount_to_pay = $trans['atp'];
                        $t->session_count = $trans['sessionCount'];
                        $t->is_session_used = $trans['useSession'];
                        $t->is_cost_price = $trans['isCostPrice'];
                        $t->updated_by = $userId;
                        $t->save();

                        if ($t->incomplete_transaction_id) {
                            $ic = IncompleteTransaction::find($t->incomplete_transaction_id);
                        }

                        if (!$q->is_draft) {

                            if ($t->product_id) {
                                $p = Product::withTrashed()->find($t->product_id);
                                $t->uom = $p->uom->description;
                                $t->usage_id = $p->usage_id;
                                $t->dosage_id = $p->dosage_id;
                                $t->dosage_uom_id = $p->dosage_uom_id;
                                $t->frequency_id = $p->frequency_id;
                                $t->save();
                                if (!$p->is_stock_unlimited) {
                                    $p->current_stock -= $t->qty;
                                    $p->save();
                                }
                            } else if ($t->package_id) {
                                if ($t->incomplete_transaction_id) {
                                    $icParent = QueueTransaction::find($ic->queue_transaction_id);
                                    $packageProducts = $icParent->packageProducts;
                                } else {
                                    $p = Package::find($t->package_id);
                                    $packageProducts = $p->packageProducts;
                                }
                                foreach ($packageProducts as $pp) {
                                    $prod = $pp->product ?? Product::withTrashed()->find($pp->product_id);
                                    if (($t->session_count > 0 && $t->is_session_used) || ($t->session_count == 0 && !$t->incomplete_transaction_id)) {
                                        $prod->current_stock -= ((($t->session_count > 0 && $t->is_session_used) ? 1 : ($t->qty == 0 ? 1 : $t->qty)) * $pp->qty);
                                        $prod->save();
                                    }

                                    $qtp = new QueueTransactionProduct;
                                    $qtp->created_by = $userId;
                                    $qtp->updated_by = $userId;
                                    $qtp->queue_transaction_id = $t->id;
                                    $qtp->product_id = $pp->product_id;
                                    $qtp->item_code = $prod->code;
                                    $qtp->name = $prod->name;
                                    $qtp->qty = $pp->qty;
                                    $qtp->uom = $prod->uom->description;
                                    $qtp->usage_id = $prod->usage_id;
                                    $qtp->dosage_id = $prod->dosage_id;
                                    $qtp->dosage_uom_id = $prod->dosage_uom_id;
                                    $qtp->frequency_id = $prod->frequency_id;
                                    $qtp->save();
                                }
                            }

                            if ($t->session_count > 0 || $t->incomplete_transaction_id || (!$t->incomplete_transaction_id && $t->sub_total > $t->amount_to_pay)) {
                                if ($t->incomplete_transaction_id) {
                                    $ic->remaining_session = $t->session_count == 0 ? 0 : $t->session_count - ($t->is_session_used);
                                } else {
                                    $ic = new IncompleteTransaction;
                                    $ic->created_by = $userId;
                                    $ic->queue_transaction_id = $t->id;
                                    $ic->product_id = $t->product_id;
                                    $ic->package_id = $t->package_id;
                                    $ic->item_code = $t->item_code;
                                    $ic->name = $t->name;
                                    $ic->session_count = $t->session_count * $t->qty;
                                    $ic->remaining_session = $ic->session_count == 0 ? 0 : $ic->session_count - ($t->is_session_used);
                                    $ic->price = $t->total_amount;
                                }
                                $ic->updated_by = $userId;

                                $remainingBalance = $t->sub_total - $t->amount_to_pay;
                                $fromOverallDiscount = 0;
                                $fromPxCredit = 0;

                                if ($overallDiscAmount > 0) {
                                    $fromOverallDiscount = $overallDiscAmount <= $remainingBalance ? $overallDiscAmount : $remainingBalance;
                                    $overallDiscAmount -= $fromOverallDiscount;
                                    $remainingBalance -= $fromOverallDiscount;
                                }

                                if ($pxCredit > 0) {
                                    $fromPxCredit = $pxCredit <= $remainingBalance ? $pxCredit : $remainingBalance;
                                    $pxCredit -= $fromPxCredit;
                                    $remainingBalance -= $fromPxCredit;
                                }

                                $ic->remaining_balance = $remainingBalance;
                                $ic->save();

                                $t->from_overall_discount = $fromOverallDiscount;
                                $t->from_px_credit = $fromPxCredit;
                                $t->session_count = $ic->session_count;
                                if ($t->is_session_used) {
                                    $t->session_no = $ic->session_count - $ic->remaining_session;
                                }
                                $t->save();
                            }
                        }
                    }
                } else {
                    $q->transactions()->delete();
                }

                if (!empty($request->payments)) {

                    $pIds = collect($request->payments)->pluck('id');
                    $q->payments()->whereNotIn('id', $pIds)->delete();

                    foreach ($request->payments as $payment) {
                        $newPayment = $payment['id'] == '0';

                        if ($newPayment) {
                            $p = new QueuePayment;
                            $p->queue_id = $id;
                            $p->created_by = \Auth::id();
                        } else {
                            $p = QueuePayment::find($payment['id']);
                        }

                        $p->payment_option_id = $payment['paymentOption'];
                        $p->amount = $payment['amount'];
                        $p->remarks = $payment['remarks'];
                        $p->updated_by = \Auth::id();
                        $p->save();
                    }
                } else {
                    $q->payments()->delete();
                }
            }

            $q->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Transaction has been updated.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $q = Queue::find($id);
        $q->delete();
        return response()->json(['errMsg' => '', 'isError' => false]);
    }


    public function void($id)
    {
        $q = Queue::find($id);
        $q->is_voided = true;
        $q->voided_date = Carbon::now();
        $q->voided_by = \Auth::id();
        $q->save();

        if ($q->px_credit) {
            $ac = PatientAvailableCredit::where([
                ['patient_id', $q->patient_id],
                ['branch_id', $q->branch_id],
            ])->first();
            if ($ac) {
                $ac->amount += $q->px_credit;
                $ac->save();
            }
        }

        foreach ($q->transactions as $t) {
            if ($t->product_id) {
                $p = Product::find($t->product_id);
                if (!$p->is_stock_unlimited) {
                    $p->current_stock += $t->qty;
                    $p->save();
                }
            } else if ($t->package_id) {
                foreach ($t->packageProducts as $pp) {
                    if (($t->session_count > 0 && $t->is_session_used) || ($t->session_count == 0 && !$t->incomplete_transaction_id)) {
                        $prod = $pp->product;
                        $prod->current_stock += ((($t->session_count > 0 && $t->is_session_used) ? 1 : ($t->qty == 0 ? 1 : $t->qty)) * $pp->qty);
                        $prod->save();
                    }
                }
            }

            if ($t->incompleteTransaction && $t->incompleteTransaction->transactions->count() == 0) {
                $t->incompleteTransaction->delete();
            }

            if ($t->amount_to_pay > 0) {
                $ic = $t->parentIncompleteTransaction ? $t->parentIncompleteTransaction : $t->incompleteTransaction;
                if ($ic) {
                    $ic->remaining_balance += ($t->amount_to_pay + $t->from_overall_discount);
                    $ic->save();
                }
            }

            if ($t->is_session_used && $t->session_count > 1) {
                $ic = $t->parentIncompleteTransaction ? $t->parentIncompleteTransaction : $t->incompleteTransaction;
                $ic->remaining_session += 1;
                $ic->save();
            }
        }


        return response()->json(['errMsg' => '', 'isError' => false]);
    }

    public function updateTimeIn(Request $request, $id)
    {
        try {

            \DB::beginTransaction();

            $q = Queue::find($id);
            $q->updated_by = \Auth::id();
            // $q->time_in = Carbon::parse($q->created_at->toDateString() . " " . $request->time);
            $q->time_in = Carbon::parse($request->time);

            $q->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Time in has been updated.']);
    }

    public function updateTimeOut(Request $request, $id)
    {
        try {

            \DB::beginTransaction();

            $q = Queue::find($id);
            $q->updated_by = \Auth::id();
            $q->time_out = Carbon::parse($request->time);

            $q->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Time out has been updated.']);
    }

    public function updateNotes(Request $request, $id)
    {
        try {

            \DB::beginTransaction();

            $q = Queue::find($id);
            $q->updated_by = \Auth::id();
            $q->notes = $request->notes;

            $q->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Notes has been updated.']);
    }

    public function updateStatus($id, $statusId)
    {
        try {

            \DB::beginTransaction();

            $q = Queue::find($id);
            $doneStatusId = QueueStatus::forDropdown($q->branch_id)->orderBy('seq_no', 'desc')->select('queue_statuses.id')->first()->id;

            $q->updated_by = \Auth::id();
            $q->queue_status_id = $statusId;

            if ($doneStatusId == $statusId) {
                $q->time_out = Carbon::now();
            }

            $q->save();

            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }

        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Queue status has been updated.']);
    }

    public function getItems(Request $request)
    {
        if ($request->ajax()) {
            $data = ViewQueueItem::active(session('branch')->id, $request->type, $request->category);

            return Datatables::of($data)
                ->make(true);
        }
    }

    public function getSessionBalances(Request $request, $patientId)
    {
        if ($request->ajax()) {
            $data = IncompleteTransaction::forQueue(session('branch')->id, $patientId);

            return Datatables::of($data)
                ->filterColumn('type', function ($query, $keyword) {
                    $query->whereRaw("t.description like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('category', function ($query, $keyword) {
                    $query->whereRaw("c.description like ?", ["%{$keyword}%"]);
                })
                ->make(true);
        }
    }

    public function invoice($id)
    {
        try {
            $q = Queue::find($id);
            $branch = $q->branch;
            $patient = $q->patient;
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json([
            'branch' => $branch->print_header,
            'branchAddress' => $branch->address,
            'branchTelNo' => $branch->tel_no,
            'branchCoRegNo' => $branch->co_reg_no,
            'patient' => $patient->full_name,
            'patientAddress' => $patient->address,
            'patientCity' => $patient->city ? $patient->city->description : '',
            'patientZipCode' => $patient->zip_code,
            'patientZipCode' => $patient->zip_code,
            'patientNRIC' => $patient->nric,
            'invoiceNo' => $q->code,
            'refNo' => $q->ref_no,
            'date' => $q->created_at,
            'doctor' => $q->attending_doctor,
            'remarks' => $q->include_invoice_remarks ? $q->transaction_remarks : '',
            'isDraft' => $q->is_draft
        ]);
    }

    public function updateItemLabel($id, Request $request)
    {
        try {
            $ids = [];
            \DB::beginTransaction();
            foreach ($request->items as $item) {
                if ($item['trProductId'] != '') {
                    $tp = QueueTransactionProduct::find($item['trProductId']);
                    if (!in_array($tp->queue_transaction_id, $ids)) {
                        $ids[] = $tp->queue_transaction_id;
                    }

                    $tp->usage_id = $item['usage'];
                    $tp->dosage_id = $item['dosage'];
                    $tp->dosage_uom_id = $item['unit'];
                    $tp->frequency_id = $item['frequency'];
                    $tp->save();
                } else {
                    $t = QueueTransaction::find($item['trId']);
                    if (!in_array($t->id, $ids)) {
                        $ids[] = $t->id;
                    }

                    $t->usage_id = $item['usage'];
                    $t->dosage_id = $item['dosage'];
                    $t->dosage_uom_id = $item['unit'];
                    $t->frequency_id = $item['frequency'];
                    $t->save();
                }
            }
            \DB::commit();
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
            \DB::rollBack();
        }
        $uoms = Uom::forDropdown()->get();
        $usages = Usage::forDropdown()->get();
        $dosages = Dosage::forDropdown()->get();
        $frequencies = Frequency::forDropdown()->get();
        return response()->json(['errMsg' => '', 'isError' => false, 'message' => 'Label has been updated.', 'ids' => $ids]);
    }

    public function editItemLabel($id, Request $request)
    {
        try {
            $q = Queue::find($id);
            $b = $q->branch;
            $p = $q->patient;
            $branch = $b->print_header;
            $branchAddress = $b->address;
            $patient = $p->code . ' ' . $p->full_name;
            $items = [];

            if (!empty($request->trIds)) {
                foreach ($request->trIds as $id) {

                    $tr = QueueTransaction::find($id);
                    if ($tr->package_id) {
                        foreach ($tr->packageProducts as $packageProduct) {
                            $prod = $packageProduct->product;

                            $items[] = [
                                'trId' => $tr->id,
                                'trProductId' => $packageProduct->id,
                                'name' => $packageProduct->name,
                                'usage' => $packageProduct->usage_id,
                                'dosage' => $packageProduct->dosage_id,
                                'uom' => $packageProduct->dosage_uom_id,
                                'frequency' => $packageProduct->frequency_id,
                            ];
                        }
                    } else {
                        $prod = $tr->product;
                        $items[] = [
                            'trId' => $tr->id,
                            'trProductId' => '',
                            'name' => $tr->name,
                            'usage' => $tr->usage_id,
                            'dosage' => $tr->dosage_id,
                            'uom' => $tr->dosage_uom_id,
                            'frequency' => $tr->frequency_id,
                        ];
                    }
                }
            }

            if (!empty($request->products)) {
                foreach ($request->products as $product) {
                    $prod = Product::find($product['id']);
                    $items[] = [
                        'trId' => '',
                        'trProductId' => '',
                        'name' => $prod->name,
                        'usage' => $prod->usage_id,
                        'dosage' => $prod->dosage_id,
                        'uom' => $prod->dosage_uom_id,
                        'frequency' => $prod->frequency_id,
                        'description' => $prod->description,
                        'qty' => $product['qty'] . ' ' . ($prod->uom->description ?? '')
                    ];
                }
            }

            if (!empty($request->packIds)) {
                foreach ($request->packIds as $id) {

                    $package = Package::find($id);

                    foreach ($package->packageProducts as $packageProduct) {
                        $prod = $packageProduct->product;

                        $items[] = [
                            'trId' => '',
                            'trProductId' => '',
                            'name' => $prod->name,
                            'usage' => $prod->usage_id,
                            'dosage' => $prod->dosage_id,
                            'uom' => $prod->dosage_uom_id,
                            'frequency' => $prod->frequency_id,
                            'description' => $prod->description,
                            'qty' => $packageProduct->qty . ' ' . ($prod->uom->description ?? '')
                        ];
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        $uoms = Uom::forDropdown()->get();
        $usages = Usage::forDropdown()->get();
        $dosages = Dosage::forDropdown()->get();
        $frequencies = Frequency::forDropdown()->get();
        return view('partials/queue/item-label-form', compact('items', 'uoms', 'usages', 'dosages', 'frequencies', 'branch', 'branchAddress', 'patient'));
    }

    public function itemLabel($id, Request $request)
    {
        try {
            $items = [];

            if (!empty($request->ids)) {
                foreach ($request->ids as $id) {

                    $tr = QueueTransaction::find($id);
                    if ($tr->package_id) {
                        foreach ($tr->packageProducts as $packageProduct) {
                            $prod = $packageProduct->product;

                            $items[] = [
                                'name' => $packageProduct->name,
                                'qty' => $packageProduct->qty . ' ' . $packageProduct->uom,
                                'description' => nl2br($prod->description),
                                'dosage' => ($packageProduct->usage->description ?? '') . ' ' . ($packageProduct->dosage->description ?? '') . ' ' . ($packageProduct->dosageUom->description ?? '') . ' ' . ($packageProduct->frequency->description ?? '')
                            ];
                        }
                    } else {
                        $prod = $tr->product;
                        $items[] = [
                            'name' => $tr->name,
                            'qty' => $tr->qty . ' ' . $tr->uom,
                            'description' => nl2br($prod->description),
                            'dosage' => ($tr->usage->description ?? '') . ' ' . ($tr->dosage->description ?? '') . ' ' . ($tr->dosageUom->description ?? '') . ' ' . ($tr->frequency->description ?? '')
                        ];
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['errMsg' => 'An error has occured upon saving. Please check your connection or contact your system administrator. <br/><br/>Error Message:<br/>' . $th->getMessage(), 'isError' => true]);
        }
        return response()->json([
            'items' => $items
        ]);
    }

    public function getSessionBalanceLogs($sbId)
    {
        $it = IncompleteTransaction::find($sbId);
        $currencySymbol = $it->queueTransaction->queue->branch->currency_symbol;

        $logs = QueueTransaction::forSessionBalanceLogs($it->queue_transaction_id, $sbId)->get();
        return view('partials/queue/session-balance-logs', compact('logs', 'currencySymbol'));
    }

    private function mapValues($q, $request)
    {
        $q->patient_id = $request->patient;
        // $q->time_in = Carbon::parse(Carbon::now()->toDateString() . " " . $request->timeIn);
        $q->time_in = Carbon::parse($request->timeIn);
        $q->notes = $request->notes;

        if ($request->appointment) {
            $q->appointment_schedule = Carbon::parse($request->appointment);
        }

        $q->save();

        if (empty($q->code)) {
            $q->code = 'QU-' . sprintf('%02d', $q->branch_id) . '-' . sprintf('%05d', $q->id);
            $q->save();
        }
    }
}
