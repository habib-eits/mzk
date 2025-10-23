<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoice</title>

    <style>
        @page {
            size: A4;
            font-family: Arial, Helvetica, sans-serif;
            margin: 10mm 10mm 3mm 10mm;
            /* top, right, bottom, left */



        }


        body .container {
            font-family: 'Montserrat', sans-serif;

            /*font-family: 'Raleway', sans-serif;*/
            /*font-family: 'Cormorant Garamond', serif;*/


            font-size: 12px;
            margin: 0;
            color: #000;
        }

        .container {
            width: 100%;
            padding-bottom: 6mm;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        /* Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .header-table td {
            vertical-align: top;
            padding: 0;
        }

        .company-info {
            color: #1a4e9c;
            font-weight: bold;
        }

        /* Title */
        .invoice-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #1a4e9c;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        /* Reference Table */
        .ref-table {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .ref-table td {
            padding: 6px 0;
        }

        /* Client & Info Table */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 6px 8px;
            vertical-align: top;
        }

        .info-table .label {
            width: 20%;
            font-weight: bold;
            color: #1a4e9c;
        }

        .info-table .value {
            width: 80%;
        }

        /* Paragraphs */
        .section-subtitle {
            font-weight: bold;
            color: #1a4e9c;
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Work Scope List */
        ul {
            margin-top: 0;
            padding-left: 18px;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .items-table th {
            background-color: #d0e4fc;
            color: #000;
            padding: 6px;
            border: 1px solid #aaa;
        }

        .items-table td {
            padding: 6px;
            border: 1px solid #aaa;
            vertical-align: top;
        }

        .items-table .text-center {
            text-align: center;
        }

        .items-table .text-right {
            text-align: right;
        }

        /* Notice Box */
        .notice-box {
            border: 1px solid #1a4e9c;
            padding: 10px;
            color: #1a4e9c;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        /* Closing paragraph */
        .closing-text {
            margin-bottom: 20px;
            line-height: 1.4;
        }

        /* Terms and Payment */
        .terms-list {
            margin-top: 5px;
            padding-left: 18px;
        }

        /* Signature Table */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            text-align: center;
        }

        .signature-table td {
            width: 50%;
            vertical-align: bottom;
            padding-top: 20px;
        }

        .signature-img,
        .stamp-img {
            height: 60px;
            display: block;
            margin: 0 auto;
        }

        .client-invoice-table th {
            background-color: #e2ecf9;
            color: #1a4e9c;
            padding: 6px;
            text-align: left;
            border: 1px solid #ccc;
        }

        .client-invoice-table td {
            padding: 6px;
            border: 1px solid #ccc;
        }

        .client-invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    @include('components.pdf_footer')
    <div class="container">

        <!-- Header -->
        <table class="header-table">
            <tr>
                <td class="w-50">
                    @include('components.logo')
                    <p class="company-info">
                        {{ strtoupper($company->Name) }}<br>
                        {{ $company->TRN }}<br>
                    </p>
                </td>
                <td class="w-50 text-right">
                    <table class="client-invoice-table">
                        <tr>
                            <th>Ref#</th>
                            <td>{{ $invoice->ReferenceNo }}</td>
                        </tr>
                        <tr>
                            <th>Invoice Date</th>
                            <td> {{ $invoice->formattedDate }} </td>
                        </tr>
                        <tr>
                            <th>Invoice Expiry</th>
                            <td>{{ $invoice->formattedDueDate }}</td>
                        </tr>
                        <tr>
                            <th>Tender No </th>
                            <td>{{ $invoice->TenderNo }}</td>
                        </tr>

                    </table>
                </td>

            </tr>
        </table>

        <!-- Title -->
        <div class="invoice-title">QUOTATION</div>

        <!-- Client & Details -->
        <table class="info-table">
            <tr>
                <td class="label">To:</td>
                <td class="value fw-bold">
                    {{ $invoice->Party->PartyName }}<br>
                    {{-- <small>ABU DHABI U.A.E</small> --}}
                </td>
            </tr>
            <tr>
                <td class="label">Attention:</td>
                <td class="value fw-bold">
                    {{ $invoice->Attension }}<br>
                    {{-- <small>TECHNICAL ENG</small> --}}
                </td>
            </tr>
            <tr>
                <td class="label">Subject:</td>
                <td class="value">
                    {{ $invoice->Subject }}
                </td>
            </tr>
            <tr>
                <td class="label">Project Engg:</td>
                <td class="value">
                    {{ $invoice->ProjectEngg }}
                </td>
            </tr>

            {{-- <tr>
            <td class="label">Project:</td>
            <td class="value">AL SAMHA 1063 - ABU DHABI</td>
        </tr> --}}
        </table>

        <div>
            <div class="section-subtitle">Project: {{ $invoice->ProjectName }}</div>
            {{-- <p>
            Thank you for your enquiry, with reference to the above mention subject,
            we are pleased to submit our best price for Paving work installation of
            Interlocking tiles & Kerb stone with Blinding Hunching.
        </p> --}}
        </div>
        <div>
            @foreach ($detailsGroupedByServiceType as $serviceTypeDetails)
                <table class="items-table" style="page-break-inside: avoid">
                    <thead>
                        <tr>
                            <th colspan="4">{{ $serviceTypeDetails->first()->serviceType->name }}</th>
                        </tr>
                        <tr>
                            <th style="width: 5%;">S/No</th>
                            <th style="width: 50%;">Item</th>
                            <th style="width: 20%;">Unit</th>
                            <th style="width: 20%;">Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceTypeDetails as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->item->ItemName . ' ' . $detail->Description }}</td>
                                <td class="text-center">{{ $detail->UnitName }}</td>
                                <td class="text-right">{{ number_format($detail->Rate, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>

        <!-- Notice -->
        <div class="notice-box">
            All The Above Prices Excluding 5% VAT
        </div>

        <div>
            {!! $invoice->scope_of_work !!}
        </div>

        <!-- Terms and Payment -->
        <div style="page-break-inside: avoid">

            {!! $invoice->terms_and_conditions !!}
            <!-- Signoff -->
            <h3><i>Kind Regards</i></h3>
            <h3>{{ strtoupper($company->Name) }}</h3>

            <!-- Signature & Stamp -->
            <table class="signature-table">
                <tr>
                    <td>
                        <img src="{{ asset('custom/mzk-sign.png') }}" alt="Authorized Signature"
                            class="signature-img" /><br>
                        <div class="fw-bold">Signature</div>
                    </td>
                    <td>
                        <img src="{{ asset('custom/mzk-tech-stamp.jpg') }}" alt="Company Stamp"
                            class="stamp-img" /><br>
                        <div class="fw-bold">Stamp</div>
                    </td>
                </tr>
            </table>
        </div>



    </div>
</body>

</html>
