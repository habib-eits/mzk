<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt Voucher</title>
    <style>
        @page {
            size: 210mm 148.5mm;
            /* Half A4 portrait */
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
        }

        .container {
            width: 100%;
        }

        .receipt-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;

        }

        .table-payment {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-payment td,
        .table-payment th {
            border: 1px solid #916c2e;
            padding: 8px;
            vertical-align: top;
        }

        .signature-stamp {
            margin-top: 40px;
        }

        .signature-stamp td {
            width: 50%;
            vertical-align: top;
        }

        .signature-img,
        .stamp-img {
            height: 60px;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        hr {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .logo {
            width: 150px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <div class="logo">
                            @include('components.logo')

                        </div>
                    </td>

                    <td style="width: 50%; vertical-align: top;">
                        <div class="company-details" style="text-align: right;">
                            <h2>{{ strtoupper($company->Name) }}</h2>
                            <p style="margin: 0;">
                                <span
                                    style="display: inline-block; width: 300px; word-wrap: break-word;">{{ $company->Address }}</span>
                                <br>
                                TRN: {{ $company->TRN }}<br>
                                Phone: {{ $company->Contact }}<br>
                                Email: {{ $company->Email }}
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <hr>

        <div class="receipt-title" style="color: cornflowerblue">{{ $voucher_master[0]->VoucherTypeName }}</div>

        <table class="table-payment">
            <tr>
                <th>Account</th>
                <th>Narration</th>
                <th>Customer</th>
                <th>Supplier</th>
                <th>DR</th>
                <th>CR</th>
            </tr>
            @foreach ($voucher_details as $detail)
                <tr>
                    <td>{{ $detail->ChartOfAccountName }}</td>
                    <td>{{ $detail->Narration }}</td>
                    <td>{{ $detail->PartyName }}</td>
                    <td>{{ $detail->SupplierName }}</td>
                    <td class="right">{{ $detail->Debit !== null ? number_format($detail->Debit, 2) : '' }}</td>
                    <td class="right">{{ $detail->Credit !== null ? number_format($detail->Credit, 2) : '' }}</td>
                </tr>
            @endforeach
        </table>

        <!-- Signature and Stamp Area -->
        <footer style="position: fixed; bottom: 40px; left: 0; right: 0; width: 100%;">
            <table style="width: 100%; margin-top: 10px; border-collapse: collapse; text-align: center;">
                <tr>
                    <td style="width: 6%;"></td>

                    <!-- Signature Label -->
                    <td style="width: 20%; vertical-align: bottom; font-weight: bold;">Signature</td>

                    <!-- Signature Image and Line -->
                    <td style="width: 20%; border-bottom: 1px solid #000; vertical-align: bottom; padding: 5px 0;">
                        @include('components.signature')

                    </td>

                    <!-- Stamp Label -->
                    <td style="width: 20%; vertical-align: bottom; font-weight: bold;">Stamp</td>

                    <!-- Stamp Image and Line -->
                    <td style="width: 20%; border-bottom: 1px solid #000; vertical-align: bottom; padding: 5px 0;">
                        @include('components.stamp')
                    </td>

                    <td style="width: 14%;"></td>
                </tr>
            </table>
        </footer>



    </div>

    </div>
</body>

</html>

<!--
AMIN UR REHMAN Managing Director
☎ +971 4 388 5983
+971 56 105 7202
3
MZK
Technical Services Co. LLC
amin@mzkgroups.ae
www.mzkgroups.ae
QOffice No. 20 (Floor 35th), Al Saqr
Business Tower, Sheikh Zayed Road, Dubai-UAE
3
MZK
Group Of Companies
-->
