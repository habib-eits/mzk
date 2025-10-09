<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Quotation</title>

    <style>


        @page {
            size: A4;
            margin: 10mm;
            font-family: Arial, Helvetica, sans-serif;            


        }

        body {
            font-family: 'Montserrat', sans-serif;
            /*font-family: 'Raleway', sans-serif;*/
            /*font-family: 'Cormorant Garamond', serif;*/


            font-size: 12px;
            margin: 0;
            color: #000;
        }

        .container {
            width: 100%;
        }

        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }

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
        .quotation-title {
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
        .client-invoice-table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td class="w-50">
                <img src="{{ asset('custom/mzk-tech-logo.png') }}" alt="Logo" style="width: 150px; height: auto;">
                <p class="company-info">
                    MZK TECHNICAL SERVICES LLC<br>
                    TRN: 104156841900003
                </p>
            </td>
            <td class="w-50 text-right">
                <table class="client-invoice-table">
                    <tr>
                        <th>From</th>
                        <td>MZK TECHNICAL SERVICES LLC</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>P.O. Box: 92191, Dubai, UAE</td>
                    </tr>
                  
                    <tr>
                        <th>Date</th>
                        <td>12564</td>
                    </tr>

                </table>
            </td>

        </tr>
    </table>

    <!-- Title -->
    <div class="quotation-title">QUOTATION</div>

    <!-- Client & Details -->
    <table class="info-table">
        <tr>
            <td class="label">To:</td>
            <td class="value fw-bold">
                M/s. TROJAN GEN CONTRACTING LLC.<br>
                <small>ABU DHABI U.A.E</small>
            </td>
        </tr>
        <tr>
            <td class="label">Attention:</td>
            <td class="value fw-bold">
                Mr. MOAMEAD ALMUSTAFA NOURELDIN MOHAMED ABDALLAH<br>
                <small>TECHNICAL ENG</small>
            </td>
        </tr>
        <tr>
            <td class="label">Subject:</td>
            <td class="value">
                Submission the Re-Quotation for Paving Work installation of Interlocking Tiles & Kerb Stone.
            </td>
        </tr>
       
        {{-- <tr>
            <td class="label">Project:</td>
            <td class="value">AL SAMHA 1063 - ABU DHABI</td>
        </tr> --}}
    </table>

    <div>
        <div class="section-subtitle">Project: AL SAMHA 1063 - ABU DHABI</div>
        {{-- <p>
            Thank you for your enquiry, with reference to the above mention subject,
            we are pleased to submit our best price for Paving work installation of
            Interlocking tiles & Kerb stone with Blinding Hunching.
        </p> --}}
    </div>



    <!-- Items: Installation of Interlock -->
    <h3 style="color: #1a4e9c;"></h3>
    <table class="items-table">
        <thead>
            <tr>
                <th colspan="4">Installation of Interlock</th>
            </tr>
            <tr>
                <th style="width: 10%;">S/No</th>
                <th style="width: 50%;">Work Description</th>
                <th style="width: 20%;">Unit</th>
                <th style="width: 20%;">Rate</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Laying of interlock</td>
            <td class="text-center">m^2</td>
            <td class="text-right">11.00</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Laying including compaction of 150mm thick granular Subbase</td>
            <td class="text-center">m^2</td>
            <td class="text-right">5.00</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Laying of Black Sand.</td>
            <td class="text-center">m^2</td>
            <td class="text-right">1.50</td>
        </tr>
        </tbody>
    </table>

    <!-- Items: Installation of Kerb Stone -->
    {{-- <h3 style="color: #1a4e9c;">Installation of Kerb Stone</h3> --}}
    <table class="items-table">
        <thead>
            <tr>
                <th colspan="4">Installation of Kerb Stone</th>
            </tr>
        <tr>
            <th style="width: 10%;">S/No</th>
            <th style="width: 50%;">Work Description</th>
            <th style="width: 20%;">Unit</th>
            <th style="width: 20%;">Rate</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Laying of Kerb Stone</td>
            <td class="text-center">Lm</td>
            <td class="text-right">09.00</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Laying of Blinding</td>
            <td class="text-center">Lm</td>
            <td class="text-right">03.00</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Laying of Haunching</td>
            <td class="text-center">Lm</td>
            <td class="text-right">02.00</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Complete shuttering Providing (MZK)</td>
            <td class="text-center">Lm</td>
            <td class="text-right">2.50</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Laying of interlock</td>
            <td class="text-center">m^2</td>
            <td class="text-right">11.00</td>
        </tr>
        </tbody>
    </table>

    <!-- Notice -->
    <div class="notice-box">
        All The Above Prices Excluding 5% VAT
    </div>
    <div>

    </div>
    <div>
        <div class="section-subtitle">Scope of Work</div>
        <ul>
            <li>Installation of Interlocking Tiles with laying of subbase, compaction and laying of black sand as per approved shop drawings.</li>
            <li>Installation of Kerb stone with blinding & hunching as per approved shop drawings.</li>
            <li>Cleaning and Protection of finished work area until the completion of the works.</li>
        </ul>
    </div>

    <!-- Closing paragraph -->
    <p class="closing-text">
        We hope you will find our price and conditions acceptable and we look forward to the pleasure
        of receiving your valued order at an early date. In case you require any further
        information or clarification, please feel free to contact Mr Amin at 0588875123.
    </p>

    <!-- Terms and Payment -->
    <div style="page-break-inside: avoid">
        <div class="section-subtitle">Terms and Conditions:</div>
        <ul class="terms-list">
            <li>The commencement date shall be as per the approved schedule and project requirements.</li>
            <li>All required materials, including subbase, interlocking tiles, black sand, kerbstones, concrete, cement mortar, etc. — will be provided by the main contractor.</li>
            <li>Electrical lights and kerbstone cut pieces shall also be supplied by the main contractor.</li>
            <li>All shuttering works for blinding and haunching will be provided by the subcontractor.</li>
            <li>Final quantities will be measured upon completion of the works.</li>
        </ul>

        <div class="section-subtitle">Payment Terms:</div>
        <ul class="terms-list">
            <li>30 days PDC from the date of submission of the monthly invoice.</li>
        </ul>

        <!-- Signoff -->
        <h3><i>Kind Regards</i></h3>
        <h3>MZK TECHNICAL SERVICES CO L.L.C</h3>

        <!-- Signature & Stamp -->
        <table class="signature-table">
            <tr>
                <td>
                    <img src="{{ asset('custom/mzk-sign.png') }}" alt="Authorized Signature" class="signature-img" /><br>
                    <div class="fw-bold">Signature</div>
                </td>
                <td>
                    <img src="{{ asset('custom/mzk-tech-stamp.jpg') }}" alt="Company Stamp" class="stamp-img" /><br>
                    <div class="fw-bold">Stamp</div>
                </td>
            </tr>
        </table>
    </div>

   

</div>
</body>
</html>
