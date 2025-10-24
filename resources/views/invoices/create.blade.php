@extends('template.tmp')
@section('title', 'Invoice')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <form id="create-update-form">
                    @csrf
                    <input type="hidden" name="InvoiceMasterID" value="{{ $invoice->InvoiceMasterID }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{-- left side --}}
                                <div class="col-md-8">

                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Customer</label>
                                        <div class="col-md-4">
                                            <select name="PartyID" class="form-select select2 mt-5" style="width:100%;">
                                                <option value="">Select</option>
                                                @foreach ($parties as $party)
                                                    <option value="{{ $party->PartyID }}"
                                                        {{ $invoice->PartyID == $party->PartyID ? 'selected' : '' }}>
                                                        {{ $party->PartyName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Attension</label>
                                        <div class="col-md-8">
                                            <input type="text" name="Attension" class="form-control"
                                                value="{{ $invoice->Attension }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Subject</label>
                                        <div class="col-md-8">
                                            <input type="text" name="Subject" class="form-control"
                                                value="{{ $invoice->Subject }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Project Name</label>
                                        <div class="col-md-8">
                                            <input type="text" name="ProjectName" class="form-control"
                                                placeholder="Project Name - location" value="{{ $invoice->ProjectName }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Project Engg</label>
                                        <div class="col-md-8">
                                            <input type="text" name="ProjectEngg" class="form-control"
                                                value="{{ $invoice->ProjectEngg }}">
                                        </div>
                                    </div>



                                </div>


                                {{-- right side --}}
                                <div class="col-md-4">

                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Reference No</label>
                                        <div class="col-md-6">
                                            <input type="text" name="ReferenceNo" class="form-control"
                                                value="{{ old('ReferenceNo', $invoice->ReferenceNo) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Invoice Date</label>
                                        <div class="col-md-6">
                                            <input type="date" name="Date" class="form-control"
                                                value="{{ $invoice->Date != null ? $invoice->Date : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Invoice Expiry</label>
                                        <div class="col-md-6">
                                            <input type="date" name="DueDate" class="form-control"
                                                value="{{ $invoice->DueDate != null ? $invoice->DueDate : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Tender No</label>
                                        <div class="col-md-6">
                                            <input type="text" name="TenderNo" class="form-control"
                                                value="{{ $invoice->TenderNo }}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row col-md-12">
                                <table id="table" class="">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Item</th>
                                            <th style="width: 25%">Work Description</th>
                                            <th style="width: 7%">Unit</th>
                                            <th style="width: 7%">Prev.</th>
                                            <th style="width: 7%">Current</th>
                                            <th style="width: 7%">Cumulative</th>
                                            <th style="width: 7%">Rate</th>
                                            <th style="width: 15%">Total</th>
                                            {{-- <th style="width: 5%"></th> --}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($invoice->details as $detail)
                                            <tr>
                                                <input type="hidden" name="service_type_id[]"
                                                    value="{{ $detail->service_type_id }}">
                                                <td>
                                                    <select name="ItemID[]" class="form-control select2 row-item-select"
                                                        style="width: 100%">
                                                        <option value="">Select</option>
                                                        @foreach ($items as $item)
                                                            <option
                                                                {{ $item->ItemID == $detail->ItemID ? 'selected' : '' }}
                                                                data-UnitName="{{ $item->UnitName }}"
                                                                data-SellingPrice="{{ $item->SellingPrice }}"
                                                                value="{{ $item->ItemID }}">{{ $item->ItemName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="Description[]" rows="1" class="form-control">{{ $detail->Description }}</textarea>
                                                </td>

                                                <td>
                                                    <select name="UnitName[]"
                                                        class="form-select form-control-sm select2 row-unit-select"
                                                        style="width: 100%">
                                                        <option value="">Select</option>
                                                        @foreach ($units as $unit)
                                                            <option
                                                                {{ $unit->UnitName == $detail->UnitName ? 'selected' : '' }}
                                                                value="{{ $unit->UnitName }}">{{ $unit->UnitName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" name="Previous[]"
                                                        class="form-control  row-previous trigger-calculation"
                                                        value="{{ $detail->Previous }}">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" name="Current[]"
                                                        class="form-control  row-current trigger-calculation"
                                                        value="{{ $detail->Current }}">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" name="Cumulative[]"
                                                        class="form-control  row-cumulative"
                                                        value="{{ $detail->Cumulative }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" name="Rate[]"
                                                        class="form-control  row-rate trigger-calculation"
                                                        value="{{ $detail->Rate }}">
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" name="Total[]"
                                                        class="form-control  row-total" value="{{ $detail->Total }}"
                                                        readonly>
                                                </td>
                                                {{-- <td class="text-center">
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="removeRow(this, event)">
                                                        <span class="bx bx-trash"></span>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="m-2">
                                <button type="button" class="btn btn-sm btn-success mt-2" onclick="addRow()">Add
                                    More</button>
                            </div> --}}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <h5>Summary</h5>
                            <div class="card">
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <th style="width:50%"></th>
                                            <th style="width:50%"></th>
                                        </tr>

                                        <tr>
                                            <td>Total Invoice Amount</td>
                                            <td>
                                                <input type="number" step="0.01" name="TotalInvoiceAmount"
                                                    id="TotalInvoiceAmount" class="form-control"
                                                    value="{{ $invoice->TotalInvoiceAmount }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Less Previous Invoice (excl 10% Ret):</td>
                                            <td>
                                                <input type="number" step="0.01" name="PrevInvExclRet"
                                                    id="PrevInvExclRet" class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->PrevInvExclRet }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                10% Retention up to
                                                <input type="text" name="RetentionMonthYear" id="RetentionMonthYear"
                                                    class="form-control trigger-summary-calcuation"
                                                    placeholder="Month & Year" value="{{ $invoice->RetentionMonthYear }}"
                                                    style="display:inline-block; width:auto; margin:0; padding:2px 5px;">
                                            </td>

                                            <td>
                                                <input type="number" step="0.01" name="RetentionAmount"
                                                    id="RetentionAmount" class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->RetentionAmount }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>SubTotal</td>
                                            <td>
                                                <input type="number" step="0.01" name="SubTotal" id="SubTotal"
                                                    class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->SubTotal }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Current 10% Retention:</td>
                                            <td>
                                                <input type="number" step="0.01" name="CurrentRetention"
                                                    id="CurrentRetention" class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->CurrentRetention }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Invoice Amount:</td>
                                            <td>
                                                <input type="number" step="0.01" name="NetInvoiceAmount"
                                                    id="NetInvoiceAmount" class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->NetInvoiceAmount }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>VAT (5%):</td>
                                            <td>
                                                <input type="number" step="0.01" name="SubtotalVat" id="SubtotalVat"
                                                    class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->SubtotalVat }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>VAT Retention (5%):</td>
                                            <td>
                                                <input type="number" step="0.01" name="CurrentRetentionVat"
                                                    id="CurrentRetentionVat"
                                                    class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->CurrentRetentionVat }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Applicable VAT:</td>
                                            <td>
                                                <input type="number" step="0.01" name="NetInvoiceAmountVat"
                                                    id="NetInvoiceAmountVat"
                                                    class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->NetInvoiceAmountVat }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Net Amount :</td>
                                            <td>
                                                <input type="number" step="0.01" name="NetAmount" id="NetAmount"
                                                    class="form-control trigger-summary-calcuation"
                                                    value="{{ $invoice->NetAmount }}" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="mt-4 text-end">
                        <a href="{{ route('work-order.index') }}" type="button"
                            class="btn btn-cancel me-2 btn-dark">Cancel</a>
                        <button type="submit" id="submit-btn" class="btn btn-submit btn-primary">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).on('change', '.trigger-calculation', function() {
            let row = $(this).closest('tr');
            let previous = parseFloat(row.find('.row-previous').val()) || 0;
            let current = parseFloat(row.find('.row-current').val()) || 0;
            let cumulative = previous + current;
            row.find('.row-cumulative').val(cumulative);

            let rate = parseFloat(row.find('.row-rate').val()) || 0;
            let total = cumulative * rate;
            row.find('.row-total').val(total.toFixed(2));

            summaryCalculation();
        });



        function summaryCalculation() {
            const totalInvoiceAmount = columnSum('.row-total');
            $('#TotalInvoiceAmount').val(totalInvoiceAmount.toFixed(2));

            const prevInvExclRet = parseFloat($('#PrevInvExclRet').val()) || 0;
            const retentionAmount = parseFloat($('#RetentionAmount').val()) || 0;
            const subtotal = totalInvoiceAmount - prevInvExclRet - retentionAmount;
            $('#SubTotal').val(subtotal.toFixed(2));

            const currentRetention = subtotal * 0.10;
            $('#CurrentRetention').val(currentRetention.toFixed(2));

            const netInvoiceAmount = subtotal - currentRetention;
            $('#NetInvoiceAmount').val(netInvoiceAmount.toFixed(2));

            const SubtotalVat = subtotal * 0.05;
            $('#SubtotalVat').val(SubtotalVat.toFixed(2));

            const currentRetentionVat = currentRetention * 0.05;
            $('#CurrentRetentionVat').val(currentRetentionVat.toFixed(2));

            const netInvoiceAmountVat = netInvoiceAmount * 0.05;
            $('#NetInvoiceAmountVat').val(netInvoiceAmountVat.toFixed(2));

            const netAmount = netInvoiceAmount + netInvoiceAmountVat;
            $('#NetAmount').val(netAmount.toFixed(2));

        }


        function columnSum(selector) {
            let sum = 0;
            $(selector).each(function() {
                let val = parseFloat($(this).val()) || 0;
                sum += val;
            });
            return sum;
        }
    </script>


    @include('invoices.js')
@endsection
