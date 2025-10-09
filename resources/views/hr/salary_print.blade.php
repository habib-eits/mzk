<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$pagetitle}}</title>
    <style type="text/css">


            @page {
                 margin-left: 0.8cm;
                margin-right: 0.8cm;
            }

            body,td,th {
  font-size: 11pt;
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

       

  
     
            
 

        

 
    </style>
 

</head>
<body onload="window.print();">



     <header >

              <table  width="400">
        <tr>
            <td width='80'><img src="{{asset('uploads/'.$branch->BranchLogo)}}" alt="Company Logo" style="width: 95px;"></td>
            <td width='340'><strong>{{$branch->BranchName}}</strong><br>
                Address: {{$branch->BranchAddress}}<br>
                {{-- Contact: {{$branc->BranchContact}}<br> --}}
                TRN:{{$branch->BranchTRN}} <br>
                Salary Month : [{{ request()->MonthName }}]
 
            </td>
            <td width="50" valign="bottom"></td>

            
        </tr>
    </table>

            
         
        </header>
   
 
  
  



  <div class="main-content">

                <div class="">
                    <div class="">

   

                        <div class="row">
                            <div class="col-md-12">
  
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"> </h4>


<div class="row">
                                         
                                        </div>
                                      
                                        <table   style="border-collapse: collapse; width: 100%" border="1">
                                            <thead>
                                             
                                                <tr style="background-color: #eee;">
                                                    <th style="width: 4% !important;">S.No</th>
                                                     <th style="width: 10% !important;">Employee Name</th>
                                                    <th style="width: 10% !important;">Job Title </th>
                                                    
                                                     <th style="width: 2% !important;">Days</th>
                                                     <th style="width: 2% !important;">Rate</th>
                                                     <th style="width: 2% !important;">Salary</th>
                                                    
                                                    
                                                     <th style="width: 2% !important;">OT</th>
                                                     <th style="width: 2% !important;">Comm</th>
                                                    
                                                    <th style="width: 2% !important; color: red;">Adv</th>
                                                    <th style="width: 2% !important; color: red;">VD</th>
                                                    <th style="width: 2% !important; color: red;">SF</th>
                                                    <th style="width: 2% !important; color: red;">SD</th>
                                                    <th style="width: 2% !important;">Secuirty Deposite</th>
                                                    
                                                     <th style="width: 2% !important;">Net Salary</th>
                                                     <th style="width: 10% !important;">Notes</th>
                                                     
                                                   </tr>


                                             

                                          
                                             </thead>
        
        
                                          <tbody>
@php
    $totalDays = $totalPerDay = $totalSalary = $totalOT = $totalCommission = 0;
    $totalAdvance = $totalVisa = $totalSD = $totalTraining = $totalSalaryDeduction = $totalNet = 0;
@endphp

@foreach ($salary as $key => $value)
    @php
        $totalDays += $value->DaysPresent;
        $totalPerDay += $value->PerDay;
        $totalSalary += $value->Salary;
        $totalOT += $value->OT;
        $totalCommission += $value->Commission;
        $totalAdvance += $value->Advance;
        $totalVisa += $value->Visa_deduction;
        $totalSD += $value->SD;
        $totalTraining += $value->training_deduction;
        $totalSalaryDeduction += $value->salary_deduction;
        $totalNet += $value->NetSalary;
    @endphp

    <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $value->EmployeeName }}</td>
        <td>{{ $value->JobTitle }}</td>
        <td style="text-align: center;">{{ $value->DaysPresent }}</td>
        <td style="text-align: center;">{{ number_format($value->PerDay) }}</td>
        <td style="text-align: center;">{{ number_format($value->Salary) }}</td>
        <td style="text-align: center;">{{ number_format($value->OT) }}</td>
        <td style="text-align: center;">{{ number_format($value->Commission) }}</td>
        <td style="text-align: center;">{{ number_format($value->Advance) }}</td>
        <td style="text-align: center;">{{ number_format($value->Visa_deduction) }}</td>
        <td style="text-align: center;">{{ number_format($value->SD) }}</td>
        <td style="text-align: center;">{{ number_format($value->training_deduction) }}</td>
        <td style="text-align: center;">{{ number_format($value->salary_deduction) }}</td>
        <td style="text-align: center; font-weight: bold;">{{ number_format($value->NetSalary) }}</td>
        <td style="text-align: center;">{{ $value->Notes }}</td>
    </tr>
@endforeach
</tbody>

<tfoot>
    <tr style="font-weight: bold; background-color: #f2f2f2;">
        <td colspan="3" align="right">Totals:</td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="center">{{ number_format($totalSalary) }}</td>
        <td align="center">{{ number_format($totalOT) }}</td>
        <td align="center">{{ number_format($totalCommission) }}</td>
        <td align="center">{{ number_format($totalAdvance) }}</td>
        <td align="center">{{ number_format($totalVisa) }}</td>
        <td align="center">{{ number_format($totalSD) }}</td>
        <td align="center">{{ number_format($totalTraining) }}</td>
        <td align="center">{{ number_format($totalSalaryDeduction) }}</td>
        <td align="center">{{ number_format($totalNet) }}</td>
        <td></td>
    </tr>
</tfoot>


                                        </table>
                                      
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->

                      

                       

                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>

</body>
</html>