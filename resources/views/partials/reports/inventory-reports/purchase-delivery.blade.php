<div id="purchaseDeliveryReportContainer" class="no-print">
    <hr class="bg-gray-600 opacity-2 no-print" />

    <h4>Purchase Deliveries from {{ $startDate }} to {{ $endDate }}</h4>
    <div class="table-responsive">
        <table id="purchaseDeliveryTable" class="table table-bordered table-striped table-hover w-100">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Order No.</th>
                    <th>PO No.</th>
                    <th>Supplier</th>
                    <th>No. of items</th>
                    <th>Delivery Status</th>
                    <th>Created By</th>
                    <th>Branch</th>
                </tr>
            </thead>
            <tbody></tbody>
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