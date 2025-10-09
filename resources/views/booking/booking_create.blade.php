@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')



<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">
  <!-- start page title -->
                        <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Create booking</h4>
            <div class="page-title-right ">
              
             
                 <a href="{{URL('/leads')}}" class="btn btn-success btn-rounded w-sm"> Back to Leads </a>
                 
              
            </div>
            
            
            
          </div>
        </div>
      </div>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   <script>
 @if(session('success'))
    toastr.options =
    {
      "closeButton" : false,
      "progressBar" : true
    }
          Command: toastr["success"]("{{session('success')}}")
    @endif
  </script>                      
 

 @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger p-1   border-3">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
                </div>
 
            @endif

               
          
            
  <div class="card shadow-sm">
      <div class="card-body">


<!-- enctype="multipart/form-data" -->
               <form action="{{URL('/BookingSave')}}" method="post" enctype="multipart/form-data">
               @csrf
<!-- start card body -->

      <div class="row">

        <input type="hidden" name="lead_id" value="{{request()->id}}">

        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Title for Calendar *</label>
        <input type="text" class="form-control" name="title" value="{{old('title')}} ">
        </div>
        </div>

        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Start Date *</label>
        <input type="datetime-local" class="form-control" name="start" value="{{date('Y-m-d\TH:i')}}">
        </div>
        </div>

        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Start Date *</label>
        <input type="datetime-local" class="form-control" name="end" value="{{date('Y-m-d\TH:i')}}">
        </div>
        </div>


        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Color *</label>
       <select class="form-control colors" id="colorSelect" name="color" style="width: 100%">
                     <option value="black"></option>
                     <option value="Orange" selected="selected"></option>
                     <option value="DodgerBlue"></option>
                     <option value="MediumSeaGreen
"></option>
                    <option value="Gray"></option>
                    <option value="SlateBlue"></option>
                    <option value="Violet"></option>
                       <option value="darkred"></option>
                     <option value="darkgreen"></option>
                    <option value="forestgreen"></option>
                    <option value="olive"></option>
                  
                    <option value="darkblue"></option>
                     <option value="darkorange"></option>
                     <option value="Teal"></option>
                     <option value="Thistle"></option>
                     <option value="SpringGreen"></option>
                     <option value="SkyBlue"></option>
                     <option value="RebeccaPurple"></option>
                     <option value="MediumOrchid"></option>
                     <option value="MediumVioletRed"></option>
                    <!-- Add all other HTML color names -->
 
  </select>
        </div>
        </div>


            <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Agent Name *</label>
             <select name="user_id" id="user_id" class="form-select select2">
          <option value="">SELET</option>

             @foreach($user as $value)
             <option value="{{$value->id}}"  >{{$value->name}}</option>
            @endforeach
            
          
        </select>
        </div>
        </div>

        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Customer *</label>
        <select name="PartyID" id="PartyID" class="form-select select2">
          <option value="">SELET</option>

            @foreach($party as $value)
             <option value="{{$value->PartyID}}" >{{$value->PartyName}}</option>
            @endforeach
            
          
        </select>
        </div>
        </div>


        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Contact *</label>
        <input type="text" class="form-control" name="client_contact" value="{{old('tel')}}">
        </div>
        </div>


       <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Address *</label>
        <input type="text" class="form-control" name="client_address" value="{{old('client_address')}}">
        </div>
        </div>


       <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Vendor Name *</label>
             <select name="SupplierID" id="SupplierID" class="form-select select2">
          <option value="">SELET</option>

            @foreach($supplier as $value)
             <option value="{{$value->SupplierID}}" >{{$value->SupplierName}}</option>
            @endforeach
            
          
        </select>
        </div>
        </div>


       <div class="col-md-2">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Vendor Cost *</label>
        <input type="text" class="form-control" name="vendor_cost" id="vendor_cost" value="{{old('vendor_cost')}}" >
        </div>
        </div>

            <div class="col-md-2">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Input VAT 5%*</label>
        <input type="text" class="form-control" name="input_vat" id="input_vat" value="{{old('amount')}}" readonly="">
        </div>
        </div>

        <div class="col-md-2">
        <div class="mb-3">
        <label for="basicpill-firstname-input">CNC Cost *</label>
        <input type="text" class="form-control" name="cnc_cost" id="cnc_cost" value="{{old('amount')}}" >
        </div>
        </div>

      <div class="col-md-2">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Output VAT 5%*</label>
        <input type="text" class="form-control" name="output_vat" id="output_vat" value="{{old('amount')}}"  readonly="">
        </div>
        </div>
    

             <div class="col-md-2">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Profit *</label>
        <input type="text" class="form-control" name="profit" id="profit"  readonly="" >
        </div>
        </div>


        <div class="col-md-2">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Net Porifit *</label>
        <input type="text" class="form-control" name="net_profit"  id="net_profit"  readonly="">
        </div>
        </div>




        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Services Required *</label>
        <input type="text" class="form-control" name="services" id="services" value="{{old('services')}}" >
        </div>
        </div>


        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Payment Status *</label>
          <select name="payment_status" id="payment_status" class="form-select select2" >
            <option value="">Select</option>
            <option value="Cash">Cash</option>
            <option value="Online">Online</option>
            <option value="Cheque">Cheque</option>
    
          </select>
        </div>
        </div>

                <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Payment Collected By *</label>
          <select name="collected_by" id="collected_by" class="form-select select2" >
            <option value="">Select</option>
             <option value="CNC" >CNC</option>
            <option value="Vendor" >Vendor</option>
    
          </select>
        </div>
        </div>





        <div class="col-md-4">
        <div class="mb-3">
        <label for="basicpill-firstname-input">Amount *</label>
        <input type="text" class="form-control" name="amount" value="{{(old('amount')) ? old('amount') : 0 }}" >
        </div>
        </div>

        <div class="col-md-4">
        <div class="mb-3">
        <label for="verticalnav-address-input">Payment Receipt </label>
            <input type="file" name="file" multiple="" class="form-control " >

        </div>
        </div>   <div class="col-md-4">
        <div class="mb-3">
        <label for="verticalnav-address-input">Invoice Proof</label>
            <input type="file" name="invoice_file" multiple="" class="form-control " >

        </div>
        </div>



        <div class="col-md-4">
        <div class="mb-3">
        <label for="verticalnav-address-input">Reason</label>
        <textarea id="verticalnav-address-input" class="form-control" rows="3" name="remarks"></textarea>
        </div>
        </div>


  



<div><button type="submit" class="btn btn-success w-sm float-right">Save </button>
     <a href="{{URL('/leads')}}" class="btn btn-secondary w-sm float-right">Cancel</a>
</div>


        <!-- end of row -->
     </div>

     </form>
        <!-- end card body -->
      </div>
        
        


      </div>
  </div>
  
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
    // Capture change event using ID
    $('#vendor_cost').keyup(function(){
        // Get the selected value
        var vendor_cost = $(this).val();

        input_vat = parseFloat(vendor_cost) * parseFloat(0.05);
         
         $('#input_vat').val(input_vat.toFixed(2));

     });

       $('#cnc_cost').keyup(function(){
        // Get the selected value
        vendor_cost =  $('#vendor_cost').val();
        cnc_cost =  $('#cnc_cost').val();
        $('#output_vat').val(output_vat.toFixed(2));


        profit = parseFloat(cnc_cost) - parseFloat(vendor_cost)  ;
         
        output_vat = parseFloat(profit) * parseFloat(0.05);

        net_profit = parseFloat(cnc_cost)+ parseFloat(output_vat);
         $('#profit').val(profit.toFixed(2));
         $('#net_profit').val(net_profit.toFixed(2));

          if(profit<0)
         {
          $('#cnc_cost').css('background-color', 'orange');
         }
         else
         {

          $('#cnc_cost').css('background-color', 'white');
         }


     });




   $('#vendor_cost').blur(function(){
        $('#cnc_cost').focus(); 

     });


    $('#cnc_cost').blur(function(){
         $('#services').focus(); 

     });


});
</script>


 
<script>
$('.colors option').each(function() {
$(this).css('background-color', $(this).val());
});

$('.colors').on('change', function() {
$(this).css('background-color', $(this).val());
});
</script>


<style type="text/css" media="screen">
    
.colors {

background-color: orange;
}

.colors option{

height: 35px;

}

select option {
  padding: 10px; /* Adjust padding as needed */
  height: 50px; /* Adjust the height of each option */
  font-size: 35px; /* Adjust font size */
}


</style>

  @endsection