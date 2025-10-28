<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Invoice</title>

    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            color: #000;
        }

        .container {
            width: 100%;
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

        .header-table,
        .client-invoice-table,
        .items-table,
        .summary-table,
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .header-table td {
            vertical-align: top;
        }

        .company-info {
            color: #1a4e9c;
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

        .project-title {
            background-color: #1a4e9c;
            color: #fff;
            padding: 8px;
            font-size: 16px;
            margin-top: 10px;
        }

        .receipt-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #1a4e9c;
            margin-top: 10px;
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

        .bank-details {
            background-color: #f0f6ff;
            padding: 10px;
            border: 1px solid #1a4e9c;
            margin-top: 15px;
        }

        .summary-table td {
            padding: 6px;
            border: 1px solid #1a4e9c;
        }

        .summary-table tr:last-child td {
            /* border-bottom: none; */
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: bottom;
            padding-top: 40px;
        }

        .signature-img,
        .stamp-img {
            height: 60px;
            display: block;
            margin: 0 auto;
        }

        .w-50 {
            width: 50%;
        }

        .w-25 {
            width: 25%;
        }

        .w-75 {
            width: 75%;
        }

        .w-100 {
            width: 100%;
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
                            <th>Tax Invoice No</th>
                            <td>{{ $invoice->InvoiceNo }}</td>
                        </tr>
                        <tr>
                            <th>Tax Invoice Date</th>
                            <td> {{ $invoice->formattedDate }} </td>
                        </tr>
                        <tr>
                            <th>Payment Terms</th>
                            <td> {{ $invoice->paymentTerms }} Days</td>
                        </tr>
                        <tr>
                            <th>Period Ending</th>
                            <td>{{ $invoice->formattedDueDate }}</td>
                        </tr>


                    </table>
                </td>

            </tr>
        </table>

        <!-- Title -->
        <div class="receipt-title">TAX INVOICE</div>
        <div class="project-title">PROJECT: {{ $invoice->ProjectName }}</div>

        <!-- Client & Invoice Details -->
        <table class="client-invoice-table">
            <tr>
                <th style="border-right: 0px solid #aaa;">Client Details</th>
                <th style="text-align: right;border-left: 0px solid #aaa;">Tender No {{ $invoice->TenderNo }}</th>
            </tr>
            <tr>
                <td><strong>{{ $invoice->Party->PartyName }}</strong></td>
                <td><strong>TRN: {{ $invoice->Party->TRN }}</strong></td>
            </tr>
            <tr>
                <td colspan="2">{{ $invoice->Location }}</td>
            </tr>
            <tr>
                <td>Project Details:</td>
                <td>{{ $invoice->Subject }}</td>
            </tr>
            <tr>
                <td>SCA Ref:</td>
                <td>{{ $invoice->SCARef }}</td>
            </tr>
        </table>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th>S/No</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Previous</th>
                    <th>Current</th>
                    <th>Cumulative</th>
                    <th>Rate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->details as $detail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $detail->item->ItemName . ' ' . $detail->Description }}</td>
                        <td>{{ $detail->UnitName }}</td>
                        <td>{{ number_format($detail->Previous, 2) }}</td>
                        <td class="text-right">{{ number_format($detail->Current, 2) }}</td>
                        <td class="text-right">{{ number_format($detail->Cumulative, 2) }}</td>
                        <td class="text-right">{{ number_format($detail->Rate, 2) }}</td>
                        <td class="text-right">{{ number_format($detail->Total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Bank + Summary -->
        <table style="width: 100%; margin-top: 15px;">
            <tr>
                <!-- Bank Details -->
                <td class="w-50" style="vertical-align: top;">
                    <div class="bank-details">
                        <p><strong>BANK DETAILS</strong></p>
                        <p><strong>Account Title:</strong> M Z K TECHNICAL SERVICES CO LLC</p>
                        <p><strong>IBAN:</strong> AE640030013229152820001</p>
                        <p><strong>Account Number:</strong> 13229152820001</p>
                        <p><strong>SWIFT:</strong> ADCBAEAXXX</p>
                        <p><strong>Bank:</strong> ABU DHABI COMMERCIAL BANK</p>
                        <p><strong>Branch:</strong> 751 / IBD-AL RIGGAH ROAD</p>
                    </div>
                    <table class="signature-table">
                        <tr>

                            <td>
                                <img src="{{ asset('custom/mzk-sign.png') }}" alt="Signature"
                                    class="signature-img"><br>
                                <strong>Authorized Signatures</strong>
                            </td>
                            <td>
                                <img src="{{ asset('custom/mzk-tech-stamp.jpg') }}" alt="Stamp"
                                    class="stamp-img"><br>
                                <strong>Company Stamp</strong>
                            </td>
                        </tr>

                    </table>

                </td>

                <!-- Summary Table -->
                <td class="w-50" style="vertical-align: top;">
                    <table class="summary-table">
                        <tr>
                            <td>Total Invoice Amount:</td>
                            <td class="text-right">{{ $invoice->TotalInvoiceAmount }}</td>
                        </tr>
                        <tr>
                            <td>Less Previous Invoice (excl 10% Ret):</td>
                            <td class="text-right">{{ $invoice->PrevInvExclRet }}</td>
                        </tr>
                        <tr>
                            <td>10% Retention up to {{ $invoice->RetentionMonthYear }}:</td>
                            <td class="text-right">{{ $invoice->RetentionAmount }}</td>
                        </tr>
                        <tr>
                            <td><strong>Sub Total:</strong></td>
                            <td class="text-right">{{ $invoice->SubTotal }}</td>
                        </tr>
                        <tr>
                            <td>Current 10% Retention:</td>
                            <td class="text-right">{{ $invoice->CurrentRetention }}</td>
                        </tr>
                        <tr>
                            <td><strong>Net Invoice Amount:</strong></td>
                            <td class="text-right">{{ $invoice->NetInvoiceAmount }}</td>
                        </tr>
                        <tr>
                            <td>VAT 5%:</td>
                            <td class="text-right">{{ $invoice->SubtotalVat }}</td>
                        </tr>
                        <tr>
                            <td>VAT Retention 5%:</td>
                            <td class="text-right">{{ $invoice->CurrentRetentionVat }}</td>
                        </tr>
                        <tr>
                            <td><strong>Applicable VAT:</strong></td>
                            <td class="text-right">{{ $invoice->NetInvoiceAmountVat }}</td>
                        </tr>
                        <tr>
                            <td><strong>NET AMOUNT AED:</strong></td>
                            <td class="text-right">{{ $invoice->NetAmount }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>Amount In Words:</strong><br>
                                {{ $amountInWords }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Signature & Stamp -->
        {{--    <table class="signature-table">
        <tr>

            <td>
                <img src="{{ asset('custom/mzk-sign.png') }}" alt="Signature" class="signature-img"><br>
                <strong>Authorized Signature</strong>
            </td>
            <td>
                <img src="{{ asset('custom/mzk-tech-stamp.jpg') }}" alt="Stamp" class="stamp-img"><br>
                <strong>Company Stamp</strong>
            </td>
        </tr>

    </table> --}}
    </div>
</body>

</html>
