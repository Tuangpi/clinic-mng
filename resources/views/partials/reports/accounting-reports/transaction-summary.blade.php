<div id="transactionSummaryReportContainer" class="no-print">
    <hr class="bg-gray-600 opacity-2 no-print" />

    <h4>Transaction Summary from {{ $startDate }} to {{ $endDate }}</h4>
    <div class="table-responsive">
        <table id="transactionSummaryTable" class="table table-bordered table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Ref. #</th>
                    <th>Patient</th>
                    <th>Modes</th>
                    <th class="text-end">Paid Amount</th>
                    <th class="text-end">Overall Discount</th>
                    <th class="text-end">Used PX Credit</th>
                    <th>Branch</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th class="text-end" colspan="5">Grand Total</th>
                    <th class="text-end"></th>
                    <th class="text-end"></th>
                    <th class="text-end"></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div id="voidedTransaction">
        <hr class="bg-gray-600 opacity-2 no-print" />
        <br>
        <h4>Voided Transactions</h4>
        <div class="table-responsive">
            <table id="voidedTransactionTable" class="table table-bordered table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Queue ID</th>
                        <th>Patient</th>
                        <th>Modes</th>
                        <th class="text-end">Paid Amount</th>
                        <th class="text-end">Overall Discount</th>
                        <th class="text-end">Used PX Credit</th>
                        <th>Voided By</th>
                        <th>Branch</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Date</th>
                        <th>Queue ID</th>
                        <th>Patient</th>
                        <th>Modes</th>
                        <th class="text-end">Paid Amount</th>
                        <th class="text-end">Overall Discount</th>
                        <th class="text-end">Used PX Credit</th>
                        <th>Voided By</th>
                        <th>Branch</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <hr class="bg-gray-600 opacity-2 no-print" />
    <br>
    <h4>Payment Modes</h4>
    <div class="table-responsive">
        <table id="paymentModesTable" class="table table-bordered table-striped table-hover w-50">
            <thead>
                <tr>
                    <th>Mode</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Grand Total</th>
                    <th class="text-end"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div id="printContainer" class="print-container text-black">
    <table width="100%" class="table-print text-black">
        <thead class="border-bottom border-dark">
            <tr>
                <td>
                    <strong>{{ $branch->print_header }}</strong><br />
                    <small>
                        <span>{{ $branch->address }}</span><br />
                        Tel1: <span>{{ $branch->tel_no }}</span>
                    </small>
                </td>
            </tr>
        </thead>
    </table>
    <br />
    <div id="printBody"></div>
    <br /><br />
    <div>
        <p class="text-black float-start">Verified By: ____________________________________</p>
        <p class="float-end">Generated Date: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</p>
    </div>
    <br>
</div>