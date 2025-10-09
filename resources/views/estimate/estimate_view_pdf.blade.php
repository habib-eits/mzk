
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
  
 <div class="container"> 
    <table  width="400">
        <tr>
            <td width='80'><img src="{{asset('documents/'.$company->Logo)}}" alt="Company Logo" style="width: 95px;"></td>
            <td width='340'><strong>{{$company->Name}}</strong><br>
                {{$company->Address}}<br>
                {{$company->Contact}}<br>
                {{$company->TRN}}
 
            </td>
            <td width="50" valign="bottom"><strong style="font-size: 18pt; bottom:0px;">QUOTE</strong></td>

            
        </tr>
    </table>


 
 
    <div class="quote-details">
        <table >
            <tr>
                <td class="bold">Quote#</td>
                <td>: {{$estimate[0]->EstimateNo}}</td>
                <td class="bold">Sales Person</td>
                <td>: {{$estimate[0]->FullName}}</td>
            </tr>
            <tr>
                <td class="bold">Quote Date</td>
                <td>: {{dateformatman2($estimate[0]->EstimateDate)}}</td>
                <td class="bold">Payment Terms</td>
                <td>: {{$estimate[0]->PaymentTerm}}</td>
            </tr>
            <tr>
                <td class="bold">Expiry Date</td>
                <td>: {{dateformatman2($estimate[0]->ExpiryDate)}}</td>
                <td class="bold">Material Availability</td>
                <td>: {{$estimate[0]->MaterialAvailability}}</td>
            </tr>
        </table>
    </div>

    <div class="bill-to">
        <div style="padding-left: 5px;"><strong >Bill To</strong></div>
        <table>
            <tr>
                <td > <div class="bold">{{$estimate[0]->PartyName}}</div>
                    @if(!empty($estimate[0]->Address)) {{$estimate[0]->Address}} <br> @endif
                    @if(!empty($estimate[0]->Phone)) {{$estimate[0]->Phone}} <br> @endif
                    @if(!empty($estimate[0]->TRN)) TRN-{{$estimate[0]->TRN}} @endif
    
                </td>
            </tr>
             
            
        </table>
    </div>

    <div class="subject">
        <strong>Subject :</strong> {!!$estimate[0]->Subject!!}
    </div>
    {{-- end of container --}}
</div>

    <div class="quote-items">
 
        <table style="border-collapse: collapse; border: 1px solid black; border-bottom: 1px solid black; width:684px;" >
            <thead>
                <th style="border-top: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">S#</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Item & Description</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Qty</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Unit</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Rate</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Tax %</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Tax (5%)</th>
                <th style="border: 1px solid black; padding: 8px; background-color: #cfe2f3; text-align: left;">Amount</th>
            </thead>
            @foreach ($estimate_detail as $key => $value)
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
                {{-- @if ($value->ItemName == 'Service') --}}

                {{-- <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td>
                <td style="border: 1px solid black; padding: 8px;"></td> --}}
                {{-- @else --}}
             <td style="border: 1px solid black; padding: 8px;">{{ $value->LS == 'NO' ? number_format($value->Qty, 0) : 'L/S' }}</td>
             <td style="border: 1px solid black; padding: 8px;">{{ $value->UnitName }}</td>
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
                            <td style="text-align: right; padding: 8px;">{{ number_format($estimate[0]->SubTotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 8px;">VAT (5%)</td>
                            <td style="text-align: right; padding: 8px;">{{ number_format($estimate[0]->Tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; padding: 8px; font-weight: bold;">Total</td>
                            <td style="text-align: right; padding: 8px; font-weight: bold;">AED <span style="font-size: 1.2em;">{{ number_format($estimate[0]->GrandTotal, 2) }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
     
        
        </table>


        
        <div class="customer-notes"><strong><u>
                
            <h3>GENERAL TERM & CONDITIONS:</h3>

        </u></strong>

    <div style="font-size: 12px; margin-top:-20px;"><?php echo $estimate[0]->CustomerNotes; ?></div>

        

    <div style="margin-top: -10px;"><strong ><u><h3>PAYMENT TERMS: </h3></u></strong></div>

        </u></strong>

        <div style="font-size: 12px; margin-top:-20px;"><?php echo $estimate[0]->DescriptionNotes; ?></div>

</div>
   
 
 
</div>







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
