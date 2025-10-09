
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation</title>
    <style>

       
        body {
            font-family: Arial, sans-serif;
            margin-top: 0.1cm;
            margin-left: 0.1cm;
            margin-right: 0.1cm;
            margin-bottom: 0cm;
            font-size: 9pt;
            
 
        }
        .container {
            width: 680px;
            border: 2px solid black;
            height: auto;   
            /* padding: 10px; */
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }
        .header img {
            width: 100px;
        }
        .company-info {
            font-size: 14px;
            float: left;
        }
        .quote-title {
            font-size: 24px;
            font-weight: bold;
        }
        .quote-details, .bill-to {
            border-bottom: 2px solid black;
            padding: 10px 0;
        }
        .quote-details table, .bill-to table {
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 5px;
        }
        .bold {
            font-weight: bold;
        }
        .subject {
            padding: 10px 5px;
        }

        header {

position: fixed;

top: -95px;

left: 0px;

right: 0px;

height: auto;

font-size: 20px !important;

/*background-color: black;*/

text-align: center;

/*border-bottom: 1px solid black;*/



}

        
        footer {

position: fixed;

bottom: -40px;

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
<body >

    <footer>

        “This document is computer generated and does not require signature”.
        <br>


  




    </footer>
  
 <div class="container bill-to"> 
    <table  width="400">
        <tr>
            <td width='80'><img src="{{asset('uploads/'.$invoice_master[0]->BranchLogo)}}" alt="Company Logo" style="width: 95px;"></td>
            <td width='340'><strong>{{$invoice_master[0]->BranchName}}</strong><br>
                Address: {{$invoice_master[0]->BranchAddress}}<br>
                {{-- Contact: {{$invoice_master[0]->BranchContact}}<br> --}}
                TRN#:{{$invoice_master[0]->BranchTRN}}
 
            </td>
            <td width="50" valign="bottom"></td>

            
        </tr>
    </table>
 

    <div style="background-color: rgb(255, 255, 255); text-align:center; border-bottom:2px solid black"><strong style="font-size: 18pt; bottom:0px;">TAX INVOICE</strong></div>
 
 
 
        <table>
            <tr>
                <td style="width: 50%"><span class="bold">Customer Code</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->PartyID}}</td>
                <td style="width: 50%"><span class="bold">MSG TRN #</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->BranchTRN}}</td>
            </tr>
            <tr>
                <td style="width: 50%"><span class="bold">Customer TRN #</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->TRN}}</td>
                <td style="width: 50%"><span class="bold">Invoice #</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->InvoiceNo}}</td>
            </tr>
            <tr>
                <td style="width: 50%"><span class="bold">Customer Name</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->PartyName}}</td>
                <td style="width: 50%"><span class="bold">Date</span> :</td>
                <td style="width: 50%">{{dateformatman2($invoice_master[0]->Date)}}</td>
            </tr>
            <tr>
                <td style="width: 50%"><span class="bold">Address</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->Address}}</td>
                 <td style="width: 50%"><span class="bold">Invoice Month</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->ReferenceNo}}</td>
                {{-- <td style="width: 50%"><span class="bold">LPO</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->PONo}}</td> --}}
            </tr>
            <tr>
                <td style="width: 50%"><span class="bold">Telephone</span> :</td>
                <td style="width: 50%">{{$invoice_master[0]->Phone}}</td>
               
            </tr>
      
             
            {{-- <tr>
                <td><span class="bold">Contact Person</span> :</td>
                <td>Mr. Muhammad Uzair Attique - Owner</td>
            </tr> --}}
          
            <tr>
                <td><span class="bold">Email</span> :</td>
                <td>{{$invoice_master[0]->Email}}</td>
            </tr>
           
        </table>


        
 

 

   
      
        
         
  
 </div>
 <table style="width: 100%; border-collapse: collapse; text-align: center;width:684px;">
    <tr style="background-color: #cfe2f3; font-weight: bold;">
        <th style="border: 1px solid black; padding: 10px; width: 40%;">Site Detail</th>
        <th style="border: 1px solid black; padding: 10px; width: 20%;">Site Location</th>
        <th style="border: 1px solid black; padding: 10px; width: 20%;">Start Date</th>
        <th style="border: 1px solid black; padding: 10px; width: 20%;">Shift Type</th>
    </tr>
    <tr>
        <td style="border: 1px solid black; padding: 10px; width: 40%; text-align:left !important;">
            {!! $invoice_master[0]->JobDetail !!}
        </td>
        
         <td style="border: 1px solid black; padding: 10px; width: 20%;">{!!$invoice_master[0]->JobLocation!!}</td>
        <td style="border: 1px solid black; padding: 10px; width: 20%;">{{dateformatman2($invoice_master[0]->JobDate)}}</td>
        <td style="border: 1px solid black; padding: 10px; width: 20%;">{{$invoice_master[0]->ShiftType}} </td>
    </tr>
</table>
    <div class="quote-items">
 
        <table style="border-collapse: collapse; border: 1px solid black; border-bottom: 1px solid black; width:684px;" >
            <thead>
                <th style="border-top: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">S#</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;" width="200">Item & Description</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Days</th>
                 <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Rate</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Tax %</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Tax (5%)</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Amount</th>
            </thead>
            @foreach ($invoice_detail as $key => $value)
            <tr valign="top">
                <td style="border: 1px solid black; padding: 8px;">{{$loop->iteration}}.</td>
                <td style="border: 1px solid black; padding: 8px;">
                    @if ($value->ItemName == 'Service')
 

                    <div class="description" style="margin-top: -10px;">
                        {!! str_replace(['<ul', '<ol'], ['<ul style="margin-left: -30px;font-size:10px; margin-top:-10px;"', '<ol style="margin-left: -30px;font-size:10px; margin-top:-10px;"'], $value->Description) !!}
                    </div>
                    
                        @else
                        <strong >{{$value->ItemName}}</strong><br>
                            <div style="margin-left: -30px;font-size:10px; margin-top:-10px;">
                                {!! $value->Description !!}</div>
                        @endif
                </td>
                {{-- @if ($value->ItemName == 'Service')

                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td> --}}
                {{-- @else --}}
             <td style="border: 1px solid black; padding: 8px;">{{ $value->LS == 'NO' ? number_format($value->Qty, 0) : 'L/S' }}</td>
                 <td style="border: 1px solid black; padding: 8px;">{{ $value->LS == 'NO' ? number_format($value->Rate, 0) : 'L/S' }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ number_format($value->TaxPer, 2) }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ number_format($value->Tax, 2) }}</td>
                <td style="border: 1px solid black; padding: 8px;">{{ number_format($value->Total, 2) }}</td>

                {{-- @endif --}}
            </tr>
            @endforeach
           

        </table>  


        <table style="border-collapse: collapse; border: 2px solid black; border-bottom: 2px solid black; width:684px;" >
            <tr>
                <td style="border: 0px solid black; padding: 8px; width: 60%; vertical-align: top;">
                    {{-- <strong>Notes</strong><br>
                    Thank you for your inquiry. We are pleased to submit our proposal for your requirement.<br>
                    We trust that the above quote meets your requirements and we look forward to your order confirmation. --}}
                </td>
                <td style="border: 0px solid black; padding: 8px; width: 30%;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="text-align: right; padding: 8px;">Sub Total</td>
                            <td style="text-align: right; padding: 8px;">{{ number_format($invoice_master[0]->SubTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 8px;">VAT (5%)</td>
                            <td style="text-align: right; padding: 8px;">{{ number_format($invoice_master[0]->Tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 8px; font-weight: bold;">Total</td>
                            <td style="text-align: right; padding: 8px; font-weight: bold;">AED <span style="font-size: 1.2em;">{{ number_format($invoice_master[0]->GrandTotal, 2) }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
     
        
        </table>


        
        {{-- <div class="customer-notes"><strong><u>
                
            <h3>GENERAL TERM & CONDITIONS:</h3>

        </u></strong>

    <div style="font-size: 12px; margin-top:-20px;"><?php //echo $invoice_master[0]->CustomerNotes; ?></div>

        

    <div style="margin-top: -10px;"><strong ><u><h3>PAYMENT TERMS: </h3></u></strong></div>

        </u></strong>

        <div style="font-size: 12px; margin-top:-20px;"><?php //echo $invoice_master[0]->DescriptionNotes; ?></div>

</div> --}}
   
 
 
</div>

<H3>BANK DETAILS</H3>

 {!!$invoice_master[0]->BankDetail!!}

 
@if(!empty($invoice_master[0]->Stamp))
    <img src="{{ asset('uploads/'.$invoice_master[0]->Stamp) }}" 
         alt="Stamp" 
         style="margin-top: 20px; width: 150px; height: 150px;">
@endif

 



<script type="text/php">



    if (isset($pdf)) { 

 //Shows number center-bottom of A4 page with $x,$y values

    $x = 520;  //X-axis i.e. vertical position 

    $y = 828; //Y-axis horizontal position

    $text = "Page {PAGE_NUM} of {PAGE_COUNT}";  //format of display message

    $font =  $fontMetrics->get_font("helvetica", "normal");

    $size = 9;

    $color = array(0,0,0);

    $word_space = 0.0;  //  default

    $char_space = 0.0;  //  default

    $angle = 0.0;   //  default

    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);

}



</script>


</body>
</html>
