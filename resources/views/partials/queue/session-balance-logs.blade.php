<div class="table-responsive">
    <table id="sessionBalancesLogTable" class="table table-bordered table-striped table-hover w-100">
        <thead>
            <tr class="bg-silver">
                <th>Queue ID</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
                <th>From Overall Discount</th>
                <th>Remaining Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->code }}</td>
                <td>{{$currencySymbol}}{{ number_format($log->total_amount, 2) }}</td>
                <td>{{$currencySymbol}}{{ number_format($log->amount_to_pay, 2) }}</td>
                <td>{{$currencySymbol}}{{ number_format($log->from_overall_discount, 2) }}</td>
                <td>{{$currencySymbol}}{{ number_format($log->balance, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Queue ID</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
                <th>From Overall Discount</th>
                <th>Remaining Balance</th>
            </tr>
        </tfoot>
    </table>
</div>