@extends('template.tmp')
@section('title', $pagetitle)

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- <script src="{{ asset('assets/invoice/js/jquery-1.11.2.min.js') }}"></script>
            <script src="{{ asset('assets/invoice/js/jquery-ui.min.js') }}"></script>
            <script src="js/ajax.js"></script> -->
    <!--
            <script src="{{ asset('assets/invoice/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('assets/invoice/js/bootstrap-datepicker.js') }}"></script>  -->


    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    <!-- multipe image upload  -->
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="multiple/dist/imageuploadify.min.css" rel="stylesheet">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <style>
        .form-control {
            display: block;
            width: 100%;
            padding: 0.47rem 0.75rem;
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0rem !important;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;

        }




        .form-select {
            display: block;
            width: 100%;
            padding: 0.47rem 1.75rem 0.47rem 0.75rem;
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0rem !important;
        }

        .select2-container .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da;
            height: 38px
        }

        .select2-container .select2-selection--single:focus {
            outline: 0
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            padding-left: .75rem;
            color: #495057
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 34px;
            width: 34px;
            right: 3px
        }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            border-color: #adb5bd transparent transparent transparent;
            border-width: 6px 6px 0 6px
        }

        .select2-container .select2-selection--single .select2-selection__placeholder {
            color: #495057
        }

        .select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #adb5bd transparent !important;
            border-width: 0 6px 6px 6px !important
        }

        .select2-container--default .select2-search--dropdown {
            /*padding: 10px;*/
            background-color: #fff
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #ced4da;
            background-color: #fff;
            color: #74788d;
            outline: 0
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #556ee6
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            /*background-color: #f8f9fa;*/
            /*color: #343a40*/
        }

        .select2-container--default .select2-results__option[aria-selected=true]:hover {
            background-color: #556ee6;
            color: #fff
        }

        .select2-results__option {
            padding: 6px 12px
        }

        .select2-container[dir=rtl] .select2-selection--single .select2-selection__rendered {
            padding-left: .75rem
        }

        .select2-dropdown {
            border: 1px solid rgba(0, 0, 0, .15);
            background-color: #fff;
            -webkit-box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03);
            box-shadow: 0 .75rem 1.5rem rgba(18, 38, 63, .03)
        }

        .select2-search input {
            border: 1px solid #f6f6f6
        }

        .select2-container .select2-selection--multiple {
            min-height: 38px;
            background-color: #fff;
            border: 1px solid #ced4da !important
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            padding: 2px .75rem
        }

        .select2-container .select2-selection--multiple .select2-search__field {
            border: 0;
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::-webkit-input-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::-moz-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field:-ms-input-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::-ms-input-placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-search__field::placeholder {
            color: #495057
        }

        .select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #eff2f7;
            border: 1px solid #f6f6f6;
            border-radius: 1px;
            padding: 0 7px
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #ced4da
        }

        .select2-container--default .select2-results__group {
            font-weight: 600
        }

        .select2-result-repository__avatar {
            float: left;
            width: 60px;
            margin-right: 10px
        }

        .select2-result-repository__avatar img {
            width: 100%;
            height: auto;
            border-radius: 2px
        }

        .select2-result-repository__statistics {
            margin-top: 7px
        }

        .select2-result-repository__forks,
        .select2-result-repository__stargazers,
        .select2-result-repository__watchers {
            display: inline-block;
            font-size: 11px;
            margin-right: 1em;
            color: #adb5bd
        }

        .select2-result-repository__forks .fa,
        .select2-result-repository__stargazers .fa,
        .select2-result-repository__watchers .fa {
            margin-right: 4px
        }

        .select2-result-repository__forks .fa.fa-flash::before,
        .select2-result-repository__stargazers .fa.fa-flash::before,
        .select2-result-repository__watchers .fa.fa-flash::before {
            content: "\f0e7";
            font-family: 'Font Awesome 5 Free'
        }

        .select2-results__option--highlighted .select2-result-repository__forks,
        .select2-results__option--highlighted .select2-result-repository__stargazers,
        .select2-results__option--highlighted .select2-result-repository__watchers {
            color: rgba(255, 255, 255, .8)
        }

        .select2-result-repository__meta {
            overflow: hidden
        }
    </style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->

                <!-- enctype="multipart/form-data" -->
                <form action="{{ URL('/BillSave') }}" method="post">
                    <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                    <div class="card shadow-sm">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Supplier </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="SupplierID" id="SupplierID" class="form-select select2 mt-5"
                                                required="">
                                                <option value="">Select</option>
                                                <?php foreach ($supplier as $key => $value) : ?>
                                                <option value="{{ $value->SupplierID }}">{{ $value->SupplierName }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none" id="WalkinCustomer">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">or Walkin Supplier
                                            </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="WalkinCustomerName"
                                                value="" placeholder="Walkin cusomter" id="1WalkinCustomerName">

                                        </div>
                                    </div>
                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Sales Person </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="UserID" id="UserID" class="form-select">
                                                <option value="">Select</option>
                                                <?php foreach ($user as $key => $value) : ?>
                                                <option value="{{ $value->UserID }}">{{ $value->FullName }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="mb-1 row ">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Job No </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="JobID" id="JobID" class="form-select select2">
                                                <option value="">Select</option>
                                                <?php foreach ($job as $key => $value) : ?>
                                                <option value="{{ $value->JobID }}">{{ $value->JobNo }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row ">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">PO No </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="PONo" id="PONo" class="form-select select2">
                                                <option value="">Select</option>
                                                <?php foreach ($po as $key => $value) : ?>
                                                <option value="{{ $value->InvoiceNo }}">{{ $value->InvoiceNo }}</option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Subject </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" id="first-name" class="form-control" name="Subject"
                                                value=""
                                                placeholder="Let your customer know what this invoice is for">

                                        </div>
                                    </div>
                                    <div class="mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="password">Tax</label> <i
                                                class="fa fa-info-circle" data-toggle="tooltip" data-placement="left"
                                                title="Use this option after creating complete Invoice."></i>
                                        </div>

                                        <div class="col-sm-9">
                                            <select name="UserI D" id="seletedVal" class="form-select"
                                                onchange="GetSelectedTextValue(this)">
                                                <?php foreach ($tax as $key => $valueX1) : ?>
                                                <option value="{{ $valueX1->TaxPer }}">{{ $valueX1->Description }}
                                                </option>
                                                <?php endforeach ?>

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Bill # </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="InvoiceNo" autocomplete="off"
                                                    class="form-control" value="BILL-{{ $vhno[0]->VHNO }}">

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
                                                        value="{{ date('Y-m-d') }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="contact-info">Due Date</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group" id="datepicker22">
                                                    <input type="text" name="DueDate" autocomplete="off"
                                                        class="form-control" placeholder="yyyy-mm-dd"
                                                        data-date-format="yyyy-mm-dd" data-date-container="#datepicker22"
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="{{ date('Y-m-d') }}">
                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label" for="password">Ref (L.P.O) # </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="ReferenceNo" autocomplete="off"
                                                    class="form-control">

                                            </div>
                                        </div>
                                    </div>


                                    <div class=" mb-1 row d-none">
                                        <div class="col-sm-3">
                                            <label class="col-form-label text-danger" for="password">Payment Mode </label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="PaymentMode" id="PaymentMode" class="form-select">
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12 d-none" id="paymentdetails">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label text-danger" for="password">Cheque Details
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" name="PaymentDetails" class="form-control ">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="invoice-spacing">

                            <div class='text-center'>

                            </div>
                            <div class='row'>
                                <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                                    <table>
                                        <thead>
                                            <tr class="bg-light borde-1 border-light " style="height: 40px;">
                                                <th width="2%" class="text-center"><input id="check_all"
                                                        type="checkbox" /></th>
                                                <th width="2%">ITEM DETAILS </th>
                                                <th width="10%" class="d-none">DESCRIPTION </th>
                                                <th width="1%">UNIT</th>
                                                <th width="1%" class="d-none">UNIT/Qty</th>
                                                <th width="4%">QUANTITY</th>
                                                <th width="4%">RATE</th>
                                              
                                                <th width="4%">AMOUNT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="p-3">
                                                <td class="p-1"><input class="case" type="checkbox" /></td>

                                                <td>
                                                    <select name="ItemID[]" class="form-control item-select select2"
                                                        style="width:100%">
                                                        <option value="">select</option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->ItemID }}">{{ $item->ItemName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td class="d-none">
                                                    <input type="text" name="Description[]"
                                                        class="row-description form-control" value="">
                                                </td>

                                                <td>
                                                    <select name="UnitName[]"
                                                        class="form-control unit-name-select select2" style="width:100%">
                                                        <option value="">select</option>
                                                        @foreach ($unit as $u)
                                                            <option value="{{ $u->UnitName }}">{{ $u->UnitName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td class="d-none">
                                                    <input type="number" step="0.01" name="UnitQty[]"
                                                        class="row-unit-qty form-control" value="">
                                                </td>

                                                <td>
                                                    <input type="number" step="0.01" name="Qty[]"
                                                        class="row-qty form-control" value="">
                                                </td>

                                                <td>
                                                    <input type="number" step="0.01" name="Rate[]"
                                                        class="row-rate form-control" value="">
                                                </td>

                                              

                                                <td>
                                                    <input type="number" step="0.01" name="ItemTotal[]"
                                                        class="row-item-total form-control" value="" readonly>
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1 mb-2" style="margin-left: 29px;">
                                <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  '>
                                    <button class="btn btn-danger delete" id="deleteRow" type="button"><i
                                            class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button>
                                    <button class="btn btn-success addmore" id="addRow" type="button"><i
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


                                    <textarea class="form-control" rows='5' name="CustomerNotes" id="note" placeholder="">Thanks for your business.</textarea>


                                    <label for="" class="mt-2">Description</label>
                                    <textarea class="form-control" rows='5' name="DescriptionNotes" id="note"
                                        placeholder="Description notes if any."></textarea>


                                    <div class="mt-2"><button type="submit"
                                            class="btn btn-success w-md float-right">Save</button>
                                        <a href="{{ URL('/DeliveryChallan') }}"
                                            class="btn btn-secondary w-md float-right">Cancel</a>

                                    </div>


                                </div>


                                <div class="col-lg-4 col-12 ">
                                    <!-- <input type="text" class="form-control" id="TotalTaxAmount" name="TaxTotal" placeholder="TaxTotal" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"> -->
                                    <form class="form-inline">

                                        <div class="form-group mt-1">
                                            <label>Sub Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" step="0.01" class="form-control" id="SubTotal"
                                                    name="SubTotal" readonly/>


                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Discount: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" step="0.01" class="form-control"
                                                    id="DiscountAmount" name="DiscountAmount" />


                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" step="0.01" class="form-control" id="Total"
                                                    name="Total" readonly/>
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Tax: &nbsp;</label>
                                            <div class="input-group">
                                                <select id="TaxPer" name="TaxPer" class="form-control"
                                                    style="width:100%">
                                                    @foreach ($tax as $t)
                                                        <option value="{{ $t->TaxPer }}">{{ $t->Description }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Tax Amount: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" step="0.01" class="form-control" id="Tax"
                                                    name="Tax" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group mt-1 d-none">
                                            <label>Shipping: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" step="0.01" class="form-control" id="Shipping"
                                                    name="Shipping" />
                                            </div>
                                        </div>

                                        <div class="form-group mt-1">
                                            <label>Grand Total: &nbsp;</label>
                                            <div class="input-group">
                                                <span
                                                    class="input-group-text bg-light">{{ session::get('Currency') }}</span>
                                                <input type="number" step="0.01" class="form-control"
                                                    id="GrandTotal" name="GrandTotal" readonly />
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                        <div>



                        </div>







                        <!--  <div class='row'>
                      <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
                        <div class="well text-center">
                      <h2>Back TO Tutorial: <a href="#"> Invoice System </a> </h2>
                    </div>
                      </div>
                    </div>   -->



                    </div>
            </div>
        </div>





        </form>


    </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {

            // =================== ROW CALCULATION ===================
            $(document).on('input change', '.row-qty, .row-rate', function() {

                let tr = $(this).closest('tr');

                let qty = parseFloat(tr.find('.row-qty').val()) || 0;
                let rate = parseFloat(tr.find('.row-rate').val()) || 0;
                // let taxPer = parseFloat(tr.find('select[name="Tax[]"]').val()) || 0;

                let itemTotal = qty * rate;
                // let taxValue = (itemTotal * taxPer) / 100;
                // let total = itemTotal + taxValue;
                let total = itemTotal;

                // tr.find('.row-tax-value').val(taxValue.toFixed(2));
                tr.find('.row-item-total').val(total.toFixed(2));

                calculateSummary();
            });

            // =================== SUMMARY CALCULATION ===================
            $(document).on('input change', '#DiscountAmount, #Shipping, #TaxPer', function(e) {
                calculateSummary();
            });

            function calculateSummary() {

                let subtotal = 0;
                let taxPer = parseFloat($('#TaxPer').val()) || 0;
                let total = 0;
                let tax = 0;

                $('table tbody tr').each(function() {
                    let rowItemTotal = parseFloat($(this).find('.row-item-total').val()) || 0;
                    subtotal += rowItemTotal;
                });

                $('#SubTotal').val(subtotal.toFixed(2));
                let discount = parseFloat($('#DiscountAmount').val()) || 0;

                total = subtotal - discount;
                $('#Total').val(total.toFixed(2));

                if(taxPer > 0)
                {
                    tax = (taxPer/100) * total;
                }
                $('#Tax').val(tax.toFixed(2));

                let shipping = parseFloat($('#Shipping').val()) || 0;

                let grandTotal = total + shipping + tax;
                $('#GrandTotal').val(grandTotal.toFixed(2));
            }

            calculateSummary();


            // =================== ADD NEW EMPTY ROW ===================
            $("#addRow").on("click", function() {

                let newRow = `
                <tr class="p-3">
                    <td class="p-1"><input class="case" type="checkbox" /></td>

                    <td>
                        <select name="ItemID[]" class="form-control item-select select2" style="width:100%">
                            <option value="">select</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->ItemID }}">{{ $item->ItemName }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="d-none">
                        <input type="text" name="Description[]" class="row-description form-control" value="">
                    </td>

                    <td>
                        <select name="UnitName[]" class="form-control unit-name-select select2" style="width:100%">
                            <option value="">select</option>
                            @foreach ($unit as $u)
                                <option value="{{ $u->UnitName }}">{{ $u->UnitName }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="d-none">
                        <input type="number" step="0.01" name="UnitQty[]" class="row-unit-qty form-control" value="">
                    </td>

                    <td>
                        <input type="number" step="0.01" name="Qty[]" class="row-qty form-control" value="">
                    </td>

                    <td>
                        <input type="number" step="0.01" name="Rate[]" class="row-rate form-control" value="">
                    </td>

                    

                    <td>
                        <input type="number" step="0.01" name="ItemTotal[]" class="row-item-total form-control" value="">
                    </td>
                </tr>
                `;

                $("table tbody").append(newRow);

                $("table tbody tr:last").find("select.select2").select2();
            });



            // =================== DELETE SELECTED ROWS ===================
            $("#deleteRow").on("click", function() {

                $(".case:checked").closest("tr").remove();

                calculateSummary();
            });

        });
    </script>



@endsection
