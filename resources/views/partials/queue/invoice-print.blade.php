<table id="invoiceTablePrint" width="100%" class="text-black hide">
    <thead style="border-bottom: 1px solid #000">
        <tr>
            <td>
                <strong class="branch"></strong><br />
                <small>
                    <span id="branchAddress"></span><br />
                    Tel1: <span id="branchTelNo"></span>
                </small>
            </td>
        </tr>
        <tr>
            <td>
                <small class="float-end">
                    Co Reg No : <span id="branchCoRegNo"></span>
                </small>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th class="pb-2">INVOICE</th>
        </tr>
        <tr>
            <td class="patient"></td>
        </tr>
        <tr>
            <td>
                <table width="100%" class="text-black">
                    <tr>
                        <td rowspan="3" width="60%">
                            <span id="patientAddress"></span><br />
                            <span id="patientCity"></span><br />
                            <span id="patientZipCode"></span>
                        </td>
                        <th>Invoice No</th>
                        <td>: <span id="invoiceNo"></span></td>
                    </tr>
                    <tr>
                        <th>Our Reference</th>
                        <td>: <span id="refNo"></span></td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>: <span id="date"></span></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="pb-2">
                <table width="100%" class="text-black">
                    <tr>
                        <td width="20%">Patient</td>
                        <td>: <span class="patient"></span><span id="patientNRIC"></span></td>
                    </tr>
                    <tr>
                        <td>Attending Doctor</td>
                        <td>: <span id="doctor"></span></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" class="text-black">

                    <tr id="itemHeader" class="border border-1 border-dark bg-gray-400">
                        <th class="p-1">DESCRIPTION</th>
                        <th class="p-1" width="15%">QTY</th>
                        <th class="p-1" width="20%" class="text-end">DISC</th>
                        <th class="p-1" width="20%" class="text-end">FEE</th>
                    </tr>
                    <tr id="preAmountPayableRow">
                        <td></td>
                        <td colspan="2" style="border-top:1px solid #000">SubTotal</td>
                        <td id="preAmountPayable" class="text-end" style="border-top:1px solid #000"></td>
                    </tr>
                    <tr id="overallDiscountRow">
                        <td></td>
                        <td colspan="2" style="border-top:1px solid #000">Overall Discount</td>
                        <td id="overallDiscount" class="text-end" style="border-top:1px solid #000"></td>
                    </tr>
                    <tr id="pxCreditRow">
                        <td></td>
                        <td colspan="2" style="border-top:1px solid #000">Patient Credit</td>
                        <td id="pxCredit" class="text-end" style="border-top:1px solid #000"></td>
                    </tr>
                    <tr id="totalAmountPayableRow">
                        <td></td>
                        <td colspan="2" style="border-top:1px solid #000">Total Amount Payable</td>
                        <td id="totalAmountPayable" class="text-end" style="border-top:1px solid #000"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" style="border-top:1px solid #000; border-bottom: 3px double #000">Outstanding
                            Balance</td>
                        <td id="balance" class="text-end"
                            style="border-top:1px solid #000; border-bottom: 3px double #000"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" class="text-black">
                    @if (config('app.show_include_invoice_remarks'))
                        <tr>
                            <td class="pt-2">
                                Remarks: <span id="remarks"></span>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="pt-2">
                            All Cheques should be crossed and made payable to:<br />
                            <strong class="branch"></strong><br />
                            *All sales are final and Non-Refundable, Non-Exchangeable and Non-Transferable.*<br />
                            This is a computer generated invoice which does not require a signature
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr id="unofficialInvoice">
            <td class="text-center pt-5">
                * This is an unofficial invoice for checking purposes only *
            </td>
        </tr>
    </tbody>
</table>