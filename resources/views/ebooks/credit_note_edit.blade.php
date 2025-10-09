@extends('tmp')
@section('title', $pagetitle)
@section('content')
    <script src="{{ asset('assets/invoice/js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{ URL('/CreditNoteUpdate') }}" method="post">
                    <input type="hidden" name="InvoiceMasterID" value="{{ $invoice_master[0]->InvoiceMasterID }}">
                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Customer </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="PartyID" id="PartyID" class="form-select select2 mt-5"
                                                name="PartyID" required="">
                                                <?php foreach ($party as $key => $value): ?>
                                                <option value="{{ $value->PartyID }}"
                                                    {{ $value->PartyID == $invoice_master[0]->PartyID ? 'selected=selected' : '' }}>
                                                    {{ $value->PartyName }}</option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row " id="WalkinCustomer">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">or Walkin Customer
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="WalkinCustomerName"
                                                value="{{ $invoice_master[0]->WalkinCustomerName }}"
                                                placeholder="Walkin cusomter" id="1WalkinCustomerName">
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Salesperson </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="UserID" id="UserID" class="form-select">
                                                <option value="">Select</option>
                                                <?php foreach ($user as $key => $value): ?>
                                                <option value="{{ $value->UserID }}"
                                                    {{ $value->UserID == $invoice_master[0]->UserID ? 'selected=selected' : '' }}>
                                                    {{ $value->FullName }}</option>
                                                <?php endforeach?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Subject </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="Subject"
                                                placeholder="Let your customer know what this invoice is for"
                                                value="{{ $invoice_master[0]->Subject }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Credit Note#
                                                </label>
                                            </div>
                                            <div class="col-sm-9 pt-2 fw-bold">
                                                <div id="invoict_type"> <input type="text" name="InvoiceNo"
                                                        id="InvoiceNo" autocomplete="off" class="form-control"
                                                        value="{{ $invoice_master[0]->InvoiceNo }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="email-id">Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker21">
                                                    <input type="text" name="Date" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker21"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ $invoice_master[0]->Date }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="contact-info">Due
                                                    Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker22">
                                                    <input type="text" name="DueDate" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker22"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ $invoice_master[0]->DueDate }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Ref (L.P.O) #
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="ReferenceNo" autocomplete="off"
                                                    class="form-control" value="{{ $invoice_master[0]->ReferenceNo }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Payment Mode </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="PaymentMode" id="PaymentMode" class="form-select">
                                                <option value="Cash"
                                                    {{ $invoice_master[0]->PaymentMode == 'Cash' ? 'selected' : '' }}>Cash
                                                </option>
                                                <option value="Cheque"
                                                    {{ $invoice_master[0]->PaymentMode == 'Cheque' ? 'selected' : '' }}>
                                                    Cheque</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="paymentdetails">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Cheque Details
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="PaymentDetails" class="form-control "
                                                    value="{{ $invoice_master[0]->PaymentDetails }}">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="invoice-spacing">
                            <div class='row'>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                    <table>
                                        <thead>
                                            <tr class="bg-light borde-1 border-light " style="height: 40px;">
                                                <th width="2%" class="text-center"><input id="check_all"
                                                        type="checkbox" /></th>
                                                <th width="10%">ITEM DETAILS </th>
                                                <th width="10%">DESCRIPTION </th>
                                                <th width="4%">QUANTITY</th>
                                                <th width="4%">RATE</th>
                                                <th width="4%">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($invoice_detail as $key => $value1)
                                                <?php $no = $key + 1; ?>
                                                <tr class="p-3">
                                                    <td class="p-1"><input class="case" type="checkbox" /></td>
                                                    <td>
                                                        <select name="ItemID0[]" id="ItemID0_{{ $no }}"
                                                            class="item form-select form-control-sm   changesNoo ">
                                                            <option value="">select</option>
                                                            @foreach ($items as $key => $value)
                                                                <option value="{{ $value->ItemID }}"
                                                                    {{ $value->ItemID == $value1->ItemID ? 'selected=selected' : '' }}>
                                                                    {{ $value->ItemName }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="ItemID[]"
                                                            id="ItemID_{{ $no }}"
                                                            value="{{ $value1->ItemID }}">
                                                    </td>
                                                    <td><input type="text" name="Description[]" id="Description_1"
                                                            class=" form-control " value="{{ $value1->Description }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="Qty[]"
                                                            id="Qty_{{ $no }}" class=" form-control changesNo"
                                                            autocomplete="off" onkeypress="return IsNumeric(event);"
                                                            ondrop="return false;" onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Qty }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="Price[]"
                                                            id="Price_{{ $no }}"
                                                            class=" form-control changesNo" autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Rate }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="ItemTotal[]"
                                                            id="ItemTotal_{{ $no }}"
                                                            class=" form-control totalLinePrice " autocomplete="off"
                                                            onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                            onpaste="return false;" step="0.01"
                                                            value="{{ $value1->Total }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1 mb-2" style="margin-left: 29px;">
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <button class="btn btn-danger delete" type="button"><i
                                            class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button>
                                    <button class="btn btn-success addmore" type="button"><i
                                            class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add More</button>
                                </div>
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <div id="result"></div>
                                </div>
                                <br>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8 col-12  ">
                                    <h6>Customer Notes: </h6>
                                    <textarea class="form-control" rows='5' name="CustomerNotes" id="note" placeholder="">{{ $invoice_master[0]->CustomerNotes }}</textarea>
                                    <label for="" class="mt-2">Description</label>
                                    <textarea class="form-control" rows='5' name="DescriptionNotes" id="note"
                                        placeholder="Description notes if any.">{{ $invoice_master[0]->DescriptionNotes }}</textarea>
                                    <iframe src="{{ URL('/Attachment') }}" width="100%" height="40%" border="0"
                                        scrolling="yes" style="overflow: hidden;"></iframe>
                                    <div class="mt-2"><button type="submit"
                                            class="btn btn-success w-md float-right">Update</button>
                                        <a href="{{ URL('/Estimate') }}"
                                            class="btn btn-secondary w-md float-right">Cancel</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 ">
                                    <form class="form-inline">
                                        <div class="form-group mt-1">
                                            <label>Sub Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>

                                                <input type="text" class="form-control" id="subTotal"
                                                    name="SubTotal" placeholder="Subtotal"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $invoice_master[0]->SubTotal }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Discount: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">%</span>

                                                <input type="text" class="form-control" id="discountper"
                                                    name="DiscountPer" placeholder="Tax"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;"
                                                    value="{{ $invoice_master[0]->DiscountPer }}">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="text" name="DiscountAmount" class="form-control"
                                                    id="discountAmount" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $invoice_master[0]->DiscountAmount }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" name="Total" class="form-control" step="0.01"
                                                    id="totalafterdisc" readonly placeholder="Total"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $invoice_master[0]->Total }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Tax: &nbsp;</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">%</span>
                                                <input type="text" class="form-control" id="taxpercentage"
                                                    name="Taxpercentage" placeholder="tax %"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $invoice_master[0]->TaxPer }}">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="text" name="TaxpercentageAmount" class="form-control"
                                                    id="taxpercentageAmount" onkeypress="return IsNumeric(event);"
                                                    ondrop="return false;" onpaste="return false;"
                                                    value="{{ $invoice_master[0]->Tax }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Shipping: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" name="Shipping" class="form-control"
                                                    step="0.01" id="shipping" placeholder="Grand Total"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $invoice_master[0]->Shipping }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Grand Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" name="Grandtotal" class="form-control"
                                                    step="0.01" id="grandtotal" placeholder="Grand Total" readonly
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" value="{{ $invoice_master[0]->GrandTotal }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Amount Paid: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" class="form-control" id="amountPaid"
                                                    name="amountPaid" placeholder="Amount Paid"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" step="0.01"
                                                    value="{{ $invoice_master[0]->Paid }}">
                                            </div>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label>Amount Due: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" class="form-control amountDue" name="amountDue"
                                                    id="amountDue" placeholder="Amount Due"
                                                    onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                    onpaste="return false;" step="0.01"
                                                    value="{{ $invoice_master[0]->Balance }}">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        var i = $('table tr').length;
        $(".addmore").on('click', function() {
            html = '<tr class="bg-light borde-1 border-light ">';
            html += '<td class="p-1"><input class="case" type="checkbox"/></td>';
            html += '<td><select name="ItemID0[]" id="ItemID0_' + i +
                '" class="form-select changesNoo"> <option value="">select</option>}@foreach ($items as $key => $value) <option value="{{ $value->ItemID }}|{{ $value->Percentage }}">{{ $value->ItemCode }}-{{ $value->ItemName }}-{{ $value->Percentage }}</option>@endforeach</select><input type="hidden" name="ItemID[]" id="ItemID_' +
                i + '"></td>';
            html += '  <td><input type="text" name="Description[]" id="Description_' + i +
                '" class=" form-control " ></td>';
            html += '<td><input type="text" name="Qty[]" id="Qty_' + i +
                '" class="form-control changesNo " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="1"></td>';
            html += '<td><input type="text" name="Price[]" id="Price_' + i +
                '" class="form-control changesNo " autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html += '<td><input type="text" name="ItemTotal[]" id="ItemTotal_' + i +
                '" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html += '</tr>';
            $('table').append(html);
            i++;
        });
        $(document).on('change', '#check_all', function() {
            $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
        });
        $(document).on('  keyup blur select', '.changesNoo', function() {
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            val = $('#ItemID0_' + id[1]).val().split("|");
            $('#ItemID_' + id[1]).val(val[0]);
            var data = <?php echo $item; ?> // this is dynamic data in json_encode(); from controller
            var item_idd = $('#ItemID_' + id[1]).val();
            var index = -1;
            var val = parseInt(item_idd);
            var json = data.find(function(item, i) {
                if (item.ItemID === val) {
                    index = i + 1;
                    return i + 1;
                }
            });
            $('#Qty_' + id[1]).val(1);
            $('#Price_' + id[1]).val(json["SellingPrice"]);
            $('#ItemTotal_' + id[1]).val((parseFloat(json["SellingPrice"]) * parseFloat($('#Qty_' + id[1]).val()))
                .toFixed(2));
            calculateTotal();
            if (isNaN($('#discountAmount').val())) {
                $('#discountAmount').val(0);
            }
            calculatediscount();
            calculateTotal();
        });
        $(".delete").on('click', function() {
            $('.case:checkbox:checked').parents("tr").remove();
            $('#check_all').prop("checked", false);
            calculateTotal();
        });
        //autocomplete script
        $(document).on('focus', '.autocomplete_txt', function() {
            type = $(this).data('type');
            if (type == 'productCode') autoTypeNo = 0;
            if (type == 'productName') autoTypeNo = 1;
            $(this).autocomplete({
                source: function(request, response) {
                    var array = $.map(prices, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[autoTypeNo],
                            value: code[autoTypeNo],
                            data: item
                        }
                    });
                    response($.ui.autocomplete.filter(array, request.term));
                },
                autoFocus: true,
                minLength: 2,
                select: function(event, ui) {
                    var names = ui.item.data.split("|");
                    id_arr = $(this).attr('id');
                    id = id_arr.split("_");
                    $('#itemNo_' + id[1]).val(names[0]);
                    $('#itemName_' + id[1]).val(names[1]);
                    $('#quantity_' + id[1]).val(1);
                    $('#price_' + id[1]).val(names[2]);
                    $('#total_' + id[1]).val(1 * names[2]);
                    calculateTotal();
                }
            });
        });
        $(document).on('change keyup blur', '.changesNo', function() {
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            Qty = $('#Qty_' + id[1]).val();
            Price = $('#Price_' + id[1]).val();
            TotalPrice = parseFloat(Qty) * parseFloat(Price);
            ItemTotal = parseFloat(TotalPrice);
            $('#ItemTotal_' + id[1]).val(ItemTotal);
            calculatediscount();
            calculateTotal();
        });
        $(document).on(' blur', '.totalLinePrice', function() {
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            total = $('#total_' + id[1]).val();
            Profit = (parseFloat(total) - parseFloat(Fare)).toFixed(2);
            $('#Service_' + id[1]).val(parseFloat(Profit) - (parseFloat(Profit / 100) * parseFloat(Tax)).toFixed(
            2));
            $('#quantity_' + id[1]).val((parseFloat(Profit / 100) * parseFloat(Tax)).toFixed(2));
        });
        $(document).on('change', '.changesNoo', function() {
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            val = $('#ItemID0_' + id[1]).val().split("|");
            $('#ItemID_' + id[1]).val(val[0]);
            calculatediscount();
        });
        function calculatediscount() {
            subTotal = 0;
            $('.totalLinePrice').each(function() {
                if ($(this).val() != '') subTotal += parseFloat($(this).val());
            });
            subTotal = parseFloat($('#subTotal').val());
            discountper = $('#discountper').val();
            if (discountper != '' && typeof(discountper) != "undefined") {
                discountamount = parseFloat(subTotal) * (parseFloat(discountper) / 100);
                $('#discountAmount').val(parseFloat(discountamount.toFixed(2)));
                total = subTotal - discountamount;
                $('#totalafterdisc').val(total.toFixed(2));
            } else {
                $('#discountper').val(0);
                alert('dd');
                $('#DiscountAmount').val(0);
                total = subTotal;
                $('#totalafterdisc').val(total.toFixed(2));
            }
        }
        $(document).on('change keyup blur onmouseover onclick', '#discountper', function() {
            calculatediscount();
            calculateTotal();
        });
        $(document).on('change keyup blur   onclick', '#taxpercentage', function() {
            calculateTotal();
        });
        $(document).on('change keyup blur   onclick', '#shipping', function() {
            calculateTotal();
        });
        function calculateTotal() {
            grand_tax = 0;
            subTotal = 0;
            total = 0;
            total2 = 0;
            sumtax = 0;
            gt = 0;
            var pretotal = 0;
            $('.totalLinePrice').each(function() {
                if ($(this).val() != '') subTotal += parseFloat($(this).val());
            });
            discountper = $('#discountper').val();
            if (discountper != '' && typeof(discountper) != "undefined") {
            }
            $('#subTotal').val(subTotal.toFixed(2));
            pretotal = $('#totalafterdisc').val();
            discountAmount = $('#discountAmount').val();
            tax = $('#tax').val();
            grand_tax = $('#taxpercentage').val();
            if (grand_tax != '' && typeof(grand_tax) != "undefined") {
                gt = pretotal * (parseFloat(grand_tax) / 100);
                $('#taxpercentageAmount').val(gt.toFixed(2));
                total2 = subTotal + gt - discountAmount;
            } else {
                $('#taxpercentage').val(0);
                total2 = subTotal - pretotal;
            }
            shipping = parseFloat($('#shipping').val());
            shipping_grand = shipping + total2;
            $('#grandtotal').val(shipping_grand.toFixed(2));
        }
        $(document).on('change keyup blur', '#amountPaid', function() {
            calculateAmountDue();
        });
        function calculateAmountDue() {
            amountPaid = $('#amountPaid').val();
            total = $('#grandtotal').val();
            if (amountPaid != '' && typeof(amountPaid) != "undefined") {
                amountDue = parseFloat(total) - parseFloat(amountPaid);
                $('.amountDue').val(amountDue.toFixed(2));
            } else {
                total = parseFloat(total).toFixed(2);
                $('.amountDue').val(total);
            }
        }
        var specialKeys = new Array();
        specialKeys.push(8, 46); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode;
            // console.log(keyCode);
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }
        $(function() {
            $.fn.datepicker.defaults.format = "dd-mm-yyyy";
            $('#invoiceDate').datepicker({
                startDate: '-3d',
                autoclose: true,
                clearBtn: true,
                todayHighlight: true
            });
        });
    </script>
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(function() {
            $('#PartyID').change(function() {
                if (this.options[this.selectedIndex].value == '1') {
                    $('#WalkinCustomer').show();
                    $('#1WalkinCustomerName').focus();
                } else {
                    $('#WalkinCustomer').hide();
                    $('#1WalkinCustomerName').val(0);
                }
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <!-- END: Content-->

@endsection
