<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Receipt Voucher</title>
    <style>
        @page {
            size: A4;
            /* Half A4 portrait */
            margin: 10mm;
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
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .table-information {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-information td,
        .table-information th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .table-client-company-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-client-company-details td,
        .table-client-company-details th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .table-items {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            border: 1px solid #000;
        }

        .table-items td,
        .table-items th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }


        .table-summary {
            width: 100%;
            border-collapse: collapse;
            border: 0px;
        }

        .table-summary td {
            border: 0px solid #000;
            padding: 5px;
            vertical-align: top;
            border-bottom: 1px solid #000;

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
            height: 40px;
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

        hr {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .logo {
            width: 150px;
            height: 80px;
        }

        .description {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .w-10 {
            width: 10%;
        }

        .w-25 {
            width: 25%;
        }

        .w-50 {
            width: 50%;
        }

        .w-75 {
            width: 75%;
        }

        .w-100 {
            width: 100%;
        }

        .fw-bold {
            font-weight: bold;
        }

        .bank-detail-col-left {
            width: 75%;
            border: 0px;
            padding: 0px;
        }

        .bank-detail-col-right {
            width: 75%;
            border: 0px;
            padding: 0px;
        }

        .receipt-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #1a4e9c;
            margin-top: 10px;
        }

        .project-title {
            background-color: #1a4e9c;
            color: #fff;
            padding: 8px;
            font-size: 16px;
            margin-top: 10px;
        }


        .client-invoice-table,
        {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
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

        .section-subtitle {
            font-weight: bold;
            color: #1a4e9c;
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .border-bottom {
            border-bottom: 1px solid #ccc;


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
                    <td style="width: 50%; vertical-align: top;text-align:right">
                        <h4>MZK TECHNICAL SERVICES LLC</h4>
                        <h4>Date: 25-09-2025</h4>
                    </td>
                </tr>
            </table>
        </div>

        <div class="receipt-title">WORK AGREEMENT</div>
        <div class="project-title">PROJECT: Electrical Work at Villa No. 35, Al Mankhool, Dubai</div>





        <table class="client-invoice-table" style="width: 100%; border-collapse: collapse;margin-top:5px">
            <tr>
                <td style="width:46.5%;border: 1px solid black;">
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <th>Main Contractor</th>
                        </tr>
                        <tr>

                            <td class="fw-bold">M Z K Technical Services Co. LLC</td>
                        </tr>
                        <tr>
                            <td>P.O. Box: 92191, Dubai, UAE </td>
                        </tr>

                        <tr>
                            <td>(Hereinafter referred to as the "Main Contractor")</td>
                        </tr>

                    </table>
                </td>
                <td style="width:53.5%;border: 1px solid black">
                    <table style="width: 100%; border-collapse: collapse">
                        <tr>
                            <th>Subcontractor</th>
                        </tr>
                        <tr>

                            <td class="fw-bold">DAN TECH Electromechanical System LLC</td>
                        </tr>
                        <tr>
                            <td>-</td>
                        </tr>

                        <tr>
                            <td>(Hereinafter referred to as the "Subcontractor")</td>
                        </tr>

                    </table>
                </td>
            </tr>

        </table>
        <div>
            <div class="section-subtitle">Scope of Work</div>
            <div>The Subcontractor agrees to undertake the following works</div>
            <ul>
                <li>Removal of all existing sockets, wiring cables, main DEWA cable, DP cable, and boundary wall cables.
                </li>
                <li>Installation of new sockets, wiring cables, normal lights, ceiling lights, and majlis lights.</li>
                <li>All work must be carried out in a professional and workmanlike manner.</li>
                <li>The Subcontractor shall be fully responsible for any damage, fault, or defect arising before the
                    final handover of the completed work.</li>
            </ul>

            <div class="section-subtitle">Contract Price</div>
            <ul>
                <li>Lump Sum Amount: AED 15,000/- (Fifteen Thousand Dirhams only), inclusive of 5% VAT.</li>
            </ul>

        </div>

        <div>
            <div class="section-subtitle">Payment Terms</div>
            <ul>
                <li>No advance payment will be made.</li>
                <li>Progress payments will be made based on the work completed and verified by the Main Contractor.</li>
            </ul>

            <div class="section-subtitle">Work Duration</div>
            <ul>
                <li>The entire scope of work shall be completed within 30 calendar days from the start date.</li>
            </ul>

            <div class="section-subtitle">Other Terms</div>
            <ul>
                <li>The Subcontractor must comply with all relevant UAE labor laws and regulations during the execution
                    of this contract.</li>
            </ul>

        </div>



        <!-- Terms and Payment -->
        {{-- style="page-break-inside: avoid" --}}
        <div style="page-break-inside: avoid">
            <div class="section-subtitle">Terms and Conditions:</div>
            <ul class="terms-list">
                <li>The commencement date shall be as per the approved schedule and project requirements.</li>
                <li>All required materials, including subbase, interlocking tiles, black sand, kerbstones, concrete,
                    cement mortar, etc. — will be provided by the main contractor.</li>
                <li>Electrical lights and kerbstone cut pieces shall also be supplied by the main contractor.</li>
                <li>All shuttering works for blinding and haunching will be provided by the subcontractor.</li>
                <li>Final quantities will be measured upon completion of the works.</li>
            </ul>

            <div class="section-subtitle">Payment Terms:</div>
            <ul class="terms-list">
                <li>30 days PDC from the date of submission of the monthly invoice.</li>
            </ul>

            <p style="margin-top: 40px; font-weight: bold; font-size: 16px;">
                Accepted and Agreed:
            </p>

            <!-- Signature & Stamp -->



            <table class=""
                style="width: 100%; border-collapse: collapse; margin-top: 30px; font-family: Arial, sans-serif;">
                <tr>
                    <td style="padding:10px;width: 20%; font-weight: bold;">From</td>
                    <td style="padding:10px;width: 30%; border-bottom: 1px solid #000;">
                        M Z K Technical Services Co. LLC
                    </td>

                    <td style="padding:10px;width: 20%; font-weight: bold;">To</td>
                    <td style="padding:10px;width: 30%; border-bottom: 1px solid #000;">
                        DAN TECH Electromechanical System LLC
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px;width: 20%; font-weight: bold;">Authorized Signatory</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        Amin ur Rehman
                    </td>

                    <td style="padding:10px;width: 20%; font-weight: bold;">Authorized Signatory</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        <!-- Leave empty for client to fill -->
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px;width: 20%; font-weight: bold;">Signature</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        <img src="{{ asset('custom/mzk-sign.png') }}" alt="Authorized Signature"
                            style="padding:10px;height: 50px;" /><br>
                    </td>

                    <td style="padding:10px;width: 20%; font-weight: bold;">Signature</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        <!-- Leave empty -->
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px;width: 20%; font-weight: bold;">Company Stamp</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        <img src="{{ asset('custom/mzk-tech-stamp.jpg') }}" alt="Company Stamp"
                            style="padding:10px;height: 60px;" /><br>
                    </td>

                    <td style="padding:10px;width: 20%; font-weight: bold;">Company Stamp</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        <!-- Leave empty -->
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px;width: 20%; font-weight: bold;">Date</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">25-09-2025</td>

                    <td style="padding:10px;width: 20%; font-weight: bold;">Date</td>
                    <td style="padding:10px;width: 30%;border-bottom: 1px solid #000;">
                        <!-- Leave empty -->
                    </td>
                </tr>
            </table>





        </div>




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
