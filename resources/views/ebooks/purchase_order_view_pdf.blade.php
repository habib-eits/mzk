<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Purcahse Order</title>
    <style type="text/css">
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: bold;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: italic;
            font-weight: normal;
        }

        @font-face {
            font-family: 'Open Sans';
            font-style: italic;
            font-weight: bold;
        }

        @page {
            margin: 0cm;
        }

        body {
            margin-top: 3cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2.5cm;
            background: #fff;
            color: #000;
            font-family: 'Open Sans', sans-serif;
            font-size: 11pt;
            line-height: 100%;
        }

        h1,
        h2,
        h3,
        h4 {
            font-weight: bold;
            margin: 0;
        }

        h1 {
            font-size: 16pt;
            margin: 5mm 0;
        }

        h2 {
            font-size: 14pt;
        }

        h3,
        h4 {
            font-size: 9pt;
        }

        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        li,
        ul {
            margin-bottom: 0.75em;
        }

        p {
            margin: 0;
            padding: 0;
        }

        p+p {
            margin-top: 1.25em;
        }

        a {
            border-bottom: 1px solid;
            text-decoration: none;
        }

        /* Basic Table Styling */
        table {
            border-collapse: collapse;
            border-spacing: 0;
            page-break-inside: always;
            border: 0;
            margin: 0;
            padding: 0;
        }

        th,
        td {
            vertical-align: top;
            text-align: left;
        }

        table.container {
            width: 100%;
            border: 0;
        }

        tr.no-borders,
        td.no-borders {
            border: 0 !important;
            border-top: 0 !important;
            border-bottom: 0 !important;
            padding: 0 !important;
            width: auto;
        }

        /* Header */
        table.head {
            margin-bottom: 12mm;
        }

        td.header img {
            max-height: 3cm;
            width: auto;
        }

        td.header {
            font-size: 16pt;
            font-weight: 700;
        }

        td.shop-info {
            width: 40%;
        }

        .document-type-label {
            text-transform: uppercase;
        }

        table.order-data-addresses {
            width: 100%;
            margin-bottom: 2mm;
        }

        td.order-data {
            width: 30%;
        }

        .invoice .shipping-address {
            width: 30%;
        }

        .packing-slip .billing-address {
            width: 30%;
        }

        td.order-data table th {
            font-weight: normal;
            padding-right: 2mm;
        }

        table.order-details {
            width: 100%;
            margin-bottom: 8mm;
        }

        .quantity,
        .price {
            width: 8%;
        }

        .product {
            width: 88%;
        }

        .sno {
            width: 3%;
        }

        .order-details tr {
            page-break-inside: always;
            page-break-after: auto;
        }

        .order-details td,
        .order-details th {
            border-bottom: 1px #ccc solid;
            border-top: 1px #ccc solid;
            padding: 0.375em;
        }

        .order-details th {
            font-weight: bold;
            text-align: left;
        }

        .order-details thead th {
            color: black;
            background-color: #b8b8b8;
            border-color: #b8b8b8;
        }

        .order-details tr.bundled-item td.product {
            padding-left: 5mm;
        }

        .order-details tr.product-bundle td,
        .order-details tr.bundled-item td {
            border: 0;
        }

        dl {
            margin: 4px 0;
        }

        dt,
        dd,
        dd p {
            display: inline;
            font-size: 7pt;
            line-height: 7pt;
        }

        dd {
            margin-left: 5px;
        }

        dd:after {
            content: "\A";
            white-space: pre;
        }

        .customer-notes {
            margin-top: 5mm;
        }

        table.totals {
            width: 100%;
            margin-top: 5mm;
        }

        table.totals th,
        table.totals td {
            border: 0;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        table.totals th.description,
        table.totals td.price {
            width: 50%;
        }

        table.totals tr:last-child td,
        table.totals tr:last-child th {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            font-weight: bold;
        }

        table.totals tr.payment_method {
            display: none;
        }

        #footer {
            position: absolute;
            bottom: 2.5cm;
            left: 0;
            right: 0;
            height: 1cm;
            text-align: center;
            /*border-top: 0.1mm solid gray;*/
            margin-bottom: 0;
            padding-top: 2mm;
        }

        .pagenum:before {
            content: counter(page);
        }

        .pagenum,
        .pagecount {
            font-family: sans-serif;
        }

        #xyz_main {
            width: 1000px;
            border: 0px solid #666666;
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -500px;
            z-index: 1000;
        }

        #bg_logo {
            width: 100%;
            height: 100%;
            border: 0px solid #666666;
            text-align: center;
            position: absolute;
            top: 33%;
            left: 25%;
            opacity: 0.2;
            z-index: -1000;
            background-repeat: no-repeat;
            background-image: url('{{ public_path('images/logo.png') }}');
            background-size: 400px 400px;

        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2.5cm;
            border-bottom: 2px solid rgb(57, 176, 255);
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
            /* background-size: cover; */
            /** Extra personal styles **/
            background-image: url('{{ public_path('images/header.png') }}');
        }

        footer {
            position: fixed;
            bottom: -0.5cm;
            left: 0cm;
            right: 0cm;
            height: 2.5cm;

            background-position: center;
            background-repeat: no-repeat;
            /* background-size: cover; */
            /** Extra personal styles **/
            background-image: url('{{ public_path('images/footer.png') }}');
        }

        #seal {
            width: 200px;
            height: 200px;
            /* border: 1px solid black; */
            position: fixed;
            bottom: 0.1cm;
            /* left: 13cm; */
            right: 6cm;
        }

        #qrCode {
            width: 75px;
            height: 75px;
            /* border: 1px solid black; */
            position: fixed;
            top: 0.3cm;
            /* left: 18.5cm; */
            right: 0.3cm;
        }

        #topLogo {
            width: 65px;
            height: 65px;
            /* border: 1px solid black; */
            position: fixed;
            top: 0.3cm;
            left: 0.3cm;
        }

        #SignTable {
            position: fixed;
            bottom: 2.5cm;
            /* left: 0.3cm; */
        }
    </style>
</head>

<body class="invoice">
    <header></header>
    <div id="qrCode">
        <img src="{{ public_path('images/QRcode.png') }}" alt="" width="100%">
    </div>
    <div id="topLogo">
        <img src="{{ public_path('images/logo.png') }}" alt="" width="100%">
    </div>
    <div id="bg_logo"> </div>
    <table width="100%" border="0" id="SignTable">
        <tr>
            <td>
                <div align="center">..............................................</div>
            </td>
            <td>
                <div align="center">..............................................</div>
            </td>
        </tr>

        <tr>
            <td>
                <div align="center">Customer's Signature</div>
            </td>
            <td>
                <div align="center">{{ $company[0]->Name }}</div>
            </td>
        </tr>
    </table>
    <div id="seal">
        <img src="{{ public_path('images/seal.png') }}" alt="" width="50%">
    </div>
    <footer></footer>
    <table class="head container">
        <tr>
            <td colspan="2" class="header">
                <div align="center">
                    <h2><u>PURCHASE ORDER</u></h2>
                    <h3 style="margin-top: 3px;"><u>TRN: {{ $company[0]->TRN }}</u></h3>
                </div>
            </td>
        </tr>
    </table>
    <table class="order-data-addresses">
        <tr>
            <td width="54%" valign="bottom" class="address billing-address">
                <strong>Supplier</strong><br>

                <span>Client: {{ $purchase_master[0]->SupplierName }} </span><br />
                @if ($purchase_master[0]->SupplierID != 1)
                    Contact: {{ $purchase_master[0]->Phone }}<br />
                    Email: {{ $purchase_master[0]->Email }}<br />
                    TRN: {{ $purchase_master[0]->TRN }}<br />
                @endif
            </td>
            <td width="30%" class="order-data">
                <table align="right" width="75%">
                    <tr class="order-number">
                        <th><span>P.O #: </span></th>
                        <td>
                            <div align="right">{{ $purchase_master[0]->PON }}</div>
                        </td>
                    </tr>
                    <tr class="order-date">
                        <th><span>Date:</span></th>
                        <td>
                            <div align="right">{{ dateformatman($purchase_master[0]->Date) }}</div>
                        </td>
                    </tr>

                    <tr class="payment-method">
                        <th><span>Ref No: </span></th>
                        <td>
                            <div align="right">{{ $purchase_master[0]->ReferenceNo }}</div>
                        </td>
                    </tr>
                    <tr class="payment-method">
                        <th><span>Job No: </span></th>
                        <td>
                            <div align="right">{{ $purchase_master[0]->JobNo }}</div>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="bottom" class="billing-address address"><strong>Subject :
                </strong>{{ $purchase_master[0]->Subject }}</td>
        </tr>
    </table>
    <table class="order-details">
        <thead>
            <tr>
                <th width="5%" class="sno">S#</th>
                {{-- <th width="20%" class="product">Item</th> --}}
                <th width="20%" class="product">Description</th>
                <th width="10%" class="quantity">Qty</th>
                <th width="10%" class="price">Rate</th>
                {{-- <th width="10%" class="price">Tax</th> --}}
                <th width="10%" class="price">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase_detail as $key => $value)
                <tr>
                    <td height="15px">{{ $key + 1 }}</td>
                    {{-- <td>{{ $value->ItemName }}</td> --}}
                    <td>{{ $value->Description }}</td>
                    <td>{{ $value->Qty }}</td>
                    <td>{{ number_format($value->Rate, 2) }}</td>
                    {{-- <td>{{ number_format($value->Tax, 2) }}</td> --}}
                    <td>{{ number_format($value->Amount, 2) }}</td>
                </tr>
            @endforeach
            <?php  for($i = 10; $i>=count($purchase_detail);$i--) { ?>

            <tr>
                <td height="15px"></td>
                {{-- <td></td> --}}
                <td></td>
                <td></td>
                {{-- <td></td> --}}
                <td></td>
                <td></td>
            </tr>

            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="no-borders">
                <td colspan="3" class="no-borders">
                    <div class="customer-notes"><strong>Customer Notes:</strong><br><br>
                        @php
                            $lines = explode("\n", $purchase_master[0]->PONotes);

                            // Remove empty lines (optional)
                            $lines = array_filter(array_map('trim', $lines));
                        @endphp
                        @foreach ($lines as $line)
                            {{ $line }} <br><br>
                        @endforeach
                    </div>
                    <div class="customer-notes"><strong>Description Notes: </strong><br><br>
                        @php
                            $liness = explode("\n", $purchase_master[0]->DeliveryNotes);

                            // Remove empty lines (optional)
                            $liness = array_filter(array_map('trim', $liness));
                        @endphp
                        @foreach ($liness as $line)
                            {{ $line }} <br><br>
                        @endforeach
                    </div>

                    <div style="padding-top: 10px;"><strong>In words </strong>:
                        <em>{{ ucwords(convert_number_to_words($purchase_master[0]->GrandTotal)) }} only/-</em>
                    </div>

                    {{-- <img src="{{ URL('/documents/' . $company[0]->Signature) }}" width="200" /> --}}
                </td>
                <td class="no-borders" colspan="4">
                    <table class="totals">
                        <tfoot>
                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">SubTotal</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($purchase_master[0]->SubTotal, 2) }}</span></span>
                                </td>
                            </tr>
                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Dis {{ $purchase_master[0]->DiscountPer }}%</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($purchase_master[0]->Discount, 2) }}</span></span>
                                </td>
                            </tr>
                            <tr class="cart_subtotal">
                                <td class="no-borders"></td>
                                <th class="description">Total</th>
                                <td class="price"><span class="totals-price"><span class="amount">
                                            {{ number_format($purchase_master[0]->GrandTotal - $purchase_master[0]->Tax, 2) }}</span></span>
                                </td>
                            </tr>
                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Tax </th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($purchase_master[0]->Tax, 2) }}</span></span>
                                </td>
                            </tr>
                            <tr class="order_total">
                                <td class="no-borders"></td>
                                <th class="description">Grand Total</th>
                                <td class="price"><span class="totals-price"><span
                                            class="amount">{{ number_format($purchase_master[0]->GrandTotal, 2) }}</span></span>
                                </td>
                            </tr>


                        </tfoot>
                    </table>
                </td>
            </tr>
        </tfoot>
    </table>


</body>

</html>
