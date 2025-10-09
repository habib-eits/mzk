<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt Voucher</title>
    <style>
        @page {
            size: A4; /* Half A4 portrait */
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
        }

        .container {width: 100%;}

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
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }
        .table-information {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-information td, .table-information th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }
        .table-client-company-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-client-company-details td, .table-client-company-details th {
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
        .table-items td, .table-items th {
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
            height: 60px;
        }

        .text-left {text-align: left;}

        .text-right {text-align: right;}
        .text-center {text-align: center;}

        hr {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .logo{
            width: 100px;
            height: 50px;
        }
        .description{
            word-wrap: break-word; 
            overflow-wrap: break-word; 
            white-space: normal;
        }
        .w-10{ width: 10%;}
        .w-25{ width: 25%;}
        .w-50{ width: 50%;}
        .w-75{ width: 75%;}
        .w-100{ width: 100%;}
        .fw-bold{ font-weight: bold;}

        .bank-detail-col-left{
            width: 75%; 
            border:0px;
            padding:0px;
        }
        .bank-detail-col-right{
            width: 75%; 
            border:0px;
            padding:0px;
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
                </td>
            </tr>
        </table>
    </div>
    <div class="receipt-title">TAX INVOICE</div>

    <table class="table-information">
        <tr>
            <td>TRN</td>
            <td>104156841900003</td>
        </tr>
        <tr>
            <td>PROJECT</td>
            <td> AL FALAH # ABU DHABI-UAE</td>
        </tr>
    </table>


    <table style="width: 100%; border-collapse: collapse;margin-top:5px">
        <tr>
            <td style="width:46.5%;border: 1px solid black;">
                <table class="w-100">
                    <tr>
                        <th class="w-25"></th>
                        <th class="w-75"></th>
                    </tr>
                    <tr>

                        <td colspan="2" class="fw-bold">National Projects and Construction LLC</td>
                    </tr>
                    <tr>
                        <td colspan="2">P.O.BOX: 7856, ABU DHABI </td>
                    </tr>
                    <tr>
                        <td>TRN: </td>
                        <td>100250705900003</td>
                    </tr>
                    <tr>
                        <td>SCA Ref:</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width:53.5%;border: 1px solid black">
                <table class="w-100">
                    <tr>
                        <th class="w-50"></th>
                        <th class="w-50"></th>
                    </tr>
                    <tr>
                        <td >Payment Terms:</td>
                        <td class="fw-bold">30 Days</td>
                    </tr>
                    <tr>
                        <td>Tax Invoice No:</td>
                        <td class="fw-bold">10001</td>
                    </tr>
                    <tr>
                        <td>Tax Invoice Date:</td>
                        <td class="fw-bold">11-08-2025</td>
                    </tr>
                    <tr>
                        <td>Period Ending:</td>
                        <td class="fw-bold">30-06-2025</td>
                    </tr>
                  
                </table>
            </td>
        </tr>
       
    </table>

    <table class="table-items">
        <thead>
            <tr>
                <td colspan="3"></td>
                <td colspan="3" class="text-center"><small>Quantity</small></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td style="width: 5%">S/No</td>
                <td style="width: 35%">Description</td>
                <td style="width: 5%">Unit</td>
                <td style="width: 10%">Previous</td>
                <td style="width: 10%">Current</td>
                <td style="width: 10%">To Date</td>
                <td style="width: 10%">Rate</td>
                <td style="width: 15%">Total</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="description">
                    is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever
                </td>
                <td>LM</td>
                <td>-</td>
                <td class="text-right">766.00</td>
                <td class="text-right">766.00</td>
                <td class="text-right">10</td>
                <td class="text-right">7660.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
    

                    <p><b>Account Title :</b> M Z K TECHNICAL SERVICES CO LLC</p>
                    <p><b>IBAN :</b> AE640030013229152820001</p>
                    <p><b>Account Number :</b> 13229152820001</p>
                    <p><b>BIC / SWIFT :</b> ADCBAEAXXX</p>
                    <p><b>Bank :</b> ABU DHABI COMMERCIAL BANK</p>
                    <p><b>Branch Code / Branch Name :</b> 751 / IBD-AL RIGGAH ROAD</p>

                </td>
                <td colspan="5" style="margin: 0px; padding:0px">
                    <table class="table-summary" >
                        <tr>
                            <td class="w-75 fw-bold">Total Invoice Amount</td>
                            <td class="w-25 text-right fw-bold">7660.00</td>
                        </tr>
                        <tr>
                            <td class="w-75 fw-bold">Vat 5%</td>
                            <td class="w-25 text-right fw-bold">383</td>
                        </tr>
                        <tr>
                            <td class="w-75 fw-bold">NET AMOUNT AED</td>
                            <td class="w-25 text-right fw-bold">8043.00</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 0px">
                                Amount In Words: <br>
                                <span class="fw-bold">Eight Thousand Forty Three Only </span>
                            
                            </td>
                           
                        </tr>
                    </table>
                </td>

            </tr>
        </tfoot>
    </table>


  

    <!-- Signature and Stamp Area -->
<footer style="position: fixed; bottom: 40px; left: 0; right: 0; width: 100%;">
    <table style="width: 100%; margin-top: 10px; border-collapse: collapse; text-align: center;">
        <tr>
            {{-- <td style="width: 0%;"></td> --}}

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