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
    
    @php
        $voucher = DB::table('v_voucher_detail')->where('VoucherMstID',$voucher_master[0]->VoucherMstID)->get();

        $party = DB::table('party')->where('PartyID',$voucher[0]->PartyID)->first();
        
        $chartOfAccount = DB::table('chartofaccount')->where('ChartOfAccountID',$voucher[0]->ChOfAcc)->first();

        $bankName = $chartOfAccount->Category == 'BANK' ? $chartOfAccount->ChartOfAccountName : 'Cash Transaction';
        

    @endphp
<div class="container">
    <div class="header">
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <div class="logo">
                        <img class="logo" src="{{ asset('documents/'.$company->Logo) }}" alt="Logo">
                    </div>
                </td>
                 @php
                    $company = DB::table('company')->first();
                @endphp
                <td style="width: 50%; vertical-align: top;">
                    <div class="company-details" style="text-align: right;">
                        <h2>{{ $company->Name }}</h2>
                        <p style="margin: 0;">
                            {{ $company->Mobile }}<br>
                            Sheikh Zayed Road, Dubai-UAE<br>
                            {{ $company->Email }}<br>
                            {{ $company->Address }}<br>
                           
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
            <td>{{$voucher_master[0]->Voucher}}</td>
            <th>Date</th>
            <td>{{ date('d-m-Y', strtotime($voucher[0]->Date)) }}</td>
        </tr>
        <tr>
            <th>Received From</th>
            <td colspan="3">{{ $party->PartyName  }} {{ $party->Phone  }}</td>
        </tr>
        <tr>
            <th>Amount</th>
            <td colspan="3">{{ env('APP_CURRENCY') }}  {{ number_format($voucher[0]->Debit*2500, 2) }}</td>
        </tr>
        <tr>
            <th>Payment Mode</th>
            <td>Bank Receipt</td>
            <th>Reference</th>
            <td>{{ $voucher[0]->RefNo != '' ? $voucher[0]->RefNo : '-'  }}</td>
        </tr>
        <tr>
            <th>Purpose / Remarks</th>
            <td colspan="3">
                {{ $voucher[0]->Narration }}

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
