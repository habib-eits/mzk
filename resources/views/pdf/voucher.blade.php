<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt Voucher</title>
    <style>
        @page {
            size: 210mm 148.5mm; /* Half A4 portrait */
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

        .table-payment td, .table-payment th {
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
        .logo{
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
                        <img class="logo" src="{{ public_path('custom/mzk-tech-logo.png') }}" alt="Logo">
                    </div>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <div class="company-details" style="text-align: right;">
                        <h2>MZK Technical Services Co. LLC</h2>
                        <p style="margin: 0;">
                            Office No. 20 (Floor 35th), Al Saqr Business Tower,<br>
                            Sheikh Zayed Road, Dubai-UAE<br>
                            NTN: 104156841900003<br>
                            Phone: +971 4 388 5983 ; +971 56 105 7202<br>
                            Email: amin@mzkgroups.ae
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <hr>

    <div class="receipt-title" style="color: cornflowerblue">Receipt Voucher</div>

    <table class="table-payment">
        <tr>
            <th>Voucher No</th>
            <td>BR-01</td>
            <th>Date</th>
            <td>06-09-2025</td>
        </tr>
        <tr>
            <th>Received From</th>
            <td colspan="3">I AM DIGITAL INFLUENCER SOCIAL MEDIA L.L.C</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td colspan="3">1050.00</td>
        </tr>
        <tr>
            <th>Payment Mode</th>
            <td>Bank Receipt</td>
            <th>Reference</th>
            <td></td>
        </tr>
        <tr>
            <th>Purpose / Remarks</th>
            <td colspan="3">
                Payment Received

            </td>
        </tr>
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
                <img src="{{ asset('custom/mzk-sign.png') }}" alt="Authorized Signature" style="height: 60px; display: block;">
            </td>

            <!-- Stamp Label -->
            <td style="width: 20%; vertical-align: bottom; font-weight: bold;">Stamp</td>

            <!-- Stamp Image and Line -->
            <td style="width: 20%; border-bottom: 1px solid #000; vertical-align: bottom; padding: 5px 0;">
                <img src="{{ asset('custom/mzk-tech-stamp.jpg') }}" alt="Company Stamp" style="height: 60px; display: block;">
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
