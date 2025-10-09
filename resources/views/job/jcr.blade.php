<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$pagetitle}}</title>
    <style type="text/css">


            @page {
                margin-top: 100px;
                margin-bottom: 100px;
                margin-left: 0.8cm;
                margin-right: 0.8cm;
            }

            body,td,th {
  font-size: 12pt;
  font-family: Arial, Helvetica, sans-serif;
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
            /*page-break-inside: always;*/
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
            margin-bottom: 2mm;
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
            margin-bottom: 0.5mm;
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
            width: 10%;
        }

        .product {
            width: 40%;
        }

        .sno {
            width: 3%;
        }

        .order-details tr {
           /* page-break-inside: always;
            page-break-after: auto;*/
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

       

  
            header {
                position: fixed;
                top: -105px;
                left: 0px;
                right: 0px;
                height: auto;
                font-size: 20px !important;
                 background-color: black;
                text-align: center;
             border-bottom: 1px solid black;

            }

            footer {
                position: fixed; 
                bottom: -100px; 
                left: 0px; 
                right: 0px;
                height: auto; 
                font-size: 11px !important;
                
                border-top: 1px solid black;
                
                text-align: center;
                padding-top: 0px;

            }



        

 
    </style>
 

</head>

<body  >
  <header >

            @if(request()->brancid==1)
            <img src="{{asset('assets/images/header1.jpg')}}" width="100%" >
            @else
            <img src="{{asset('assets/images/header2.jpg')}}" width="100%" >

            @endif

            
         
        </header>
   
 
  
    <footer> 
          @if(request()->brancid==1)
            <img src="{{asset('assets/images/footer1.jpg')}}" width="100%" >
            @else
            <img src="{{asset('assets/images/footer2.jpg')}}" width="100%" >

            @endif


        </footer>


    
 

        <table border="1" cellspacing="0" cellpadding="5" width="100%" style="border-collapse: collapse;margin-top: 50px;">
            <tr>
                <td colspan="3" style="background: #5da7d1; color: white; font-weight: bold; text-align: center;">JOB COMPLETION REPORT</td>
            </tr>
            <tr>
                <td> <strong>{{$job->JobNo}}</strong></td>
                <td> </td>
                <td>Date: <strong>{{date('d/m/Y')}}</strong></td>
            </tr>
            <tr>
                <td colspan="3">Name of Client: <strong>{{$job->PartyName}}</strong></td>
            </tr>
            <tr>
                <td colspan="3">Location: <strong>{{$job->JobLocation}}</strong></td>
            </tr>
            <tr>
                <td colspan="3">Date of Completion: <strong>{{dateformatman2($job->JobDueDate)}}</strong></td>
            </tr>
            {{-- <tr>
                <td colspan="3" >Confirmation: <input type="checkbox"> By Fax <input type="checkbox" checked> Letter <input type="checkbox" checked> Verbal <input type="checkbox"> Others</td>
            </tr> --}}
            <tr>
                <td colspan="3" style="font-weight: bold; background-color:#5da7d1; ">DESCRIPTION OF WORKS</td>
            </tr>
            {{-- <tr>
                <td colspan="3"><strong>Construction of Concrete Skimmer Swimming Pool.</strong></td>
            </tr> --}}
            <tr>
                <td colspan="3">
                    {!! $job->JobDetail!!}
                </td>
            </tr>
            <tr>
                <td style="width: 33.33%;"><strong>Engineer</strong></td>
                <td style="width: 33.33%;"><strong>Manager</strong></td>
                <td style="width: 33.33%;"><strong>Client</strong></td>
            </tr>
            <tr>
                <td>Name: Muhammad Uzair</td>
                <td>Name: Muhammad Uzair</td>
                <td>Name: {{$job->PartyName}}</td>
            </tr>
            <tr>
                <td>Date: {{date('d/m/Y')}}</td>
                <td>Date: {{date('d/m/Y')}}</td>
                <td>Date: {{date('d/m/Y')}}</td>
                
                
                
            </tr>
            <tr >
                <td style="height: 180px;vertical-align: bottom;">Signature: __________</td>
                <td style="height: 180px;vertical-align: bottom;">Signature: __________</td>
                <td style="height: 180px;vertical-align: bottom;">Signature / Stamp: __________</td>
            </tr>
            <tr>
                <td colspan="3"><strong>Remarks:</strong></td>
            </tr>
        </table>

        @php
$company = DB::table('company')->first();
        @endphp

        <br>
        <p>Yours faithfully,</p>
        <p>On behalf of <strong>{{ $company->Name}} }}</strong><br>
        <strong>Accounts Department</strong><br>
        M: +971 56 123 456<br>
        Tel: +971 56 1234</p>
        {{-- <img src="stamp.png" alt="Company Stamp" width="100px"> --}}
 



  

            


 

 
                    

 
 


  
 

</body>

</html>


         