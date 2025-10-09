@extends('template.tmp')


@section('title', $pagetitle)
 

@section('content')

     

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        
    <!-- BEGIN: Custom CSS-->
     <!-- END: Custom CSS-->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
  

    <style type="text/css">
      
        .form-control {
    display: block;
    width: 100%;
    padding: 0.47rem 0.55rem !important;
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
     border-radius: 0rem !important; 
    -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;

}


.container { margin:30px auto; max-width:600px;}

.form-select {
    display: block;
    width: 100%;
    padding: 0.47rem 0.55rem !important;
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0rem !important; 
}

      .select2
      {
      border-radius: 0 !important;
      width: 250px !important;

      }



      body
      {
        background-color: white;
      }

    


    </style>




<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">
<div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Journal Voucher</h4>
                                         <div class="page-title-right ">
                                       
                                       
                                    </div>  
                                           
                                      

                                    

                                </div>
                            </div>
                        </div>

          <div class="row">
  <div class="col-12">
  
 
          <!-- enctype="multipart/form-data" -->
<form action="{{URL('/JVSave')}}" method="post"> 

 
      <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">

 
 <div class="card shadow-sm">
     <div class="card-body">
     


<div class="row">
 
 

 
<div class="col-6">
 

<input type="hidden" name="VoucherType" id="VoucherType" class="form-control">

<textarea name="Narration_mst" id="Narration" cols="30" rows="5" class="form-control " placeholder="Narration"></textarea>
<div class="clearfix mt-1"></div>
 
 
</div>
 
   <div class="col-6">


    <div class="row">
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="first-name">Invoice #</label>
                  </div>
                  <div class="col-sm-9">
                    <div id="vhno_div"> <img src="{{asset('assets/images/ajax.gif')}}" alt="">
                     </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="password">Voucher Type</label>
                  </div>
                  <div class="col-sm-9">
                   <select class="form-select changesNooo" name="InvoiceType1" id="InvoiceType1">
   <?php foreach ($voucher_type as $key => $value): ?>
     <option value="{{$value->VoucherTypeID}}-{{$value->VoucherCode}}">{{$value->VoucherCode}}-{{$value->VoucherTypeName}}</option>
   <?php endforeach ?>
</select> 
                  </div>
                </div>
              </div>

               <div class="col-12 d-none">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="password">Chart of Account</label>
                  </div>
                  <div class="col-sm-9">
                   <select class="form-select changesNooo" name="InvoiceType1" id="InvoiceType1">
   <?php foreach ($chartofaccount as $key => $value): ?>
     <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
   <?php endforeach ?>
</select> 
                  </div>
                </div>
              </div>


              <div class="col-12">
                <div class="mb-1 row">
                  <div class="col-sm-3">
                    <label class="col-form-label" for="email-id">Date</label>
                  </div>
                   <div class="col-sm-9">
                     <div class="input-group" id="datepicker21">
  <input type="text" name="VHDate"  id="VHDate" autocomplete="off" class="form-control" placeholder="yyyy-mm-dd" data-date-format="yyyy-mm-dd" data-date-container="#datepicker21" data-provide="datepicker" data-date-autoclose="true" value="{{date('Y-m-d')}}">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
                  </div>
                </div>
              </div>
           
              


              
               
              
              
             
            </div>
    

 
  </div>
</div>



    <hr class="invoice-spacing">
       
    <div class='text-center'>
      
    </div>
        <div class='row'>
          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <table   style="border-collapse: collapse;" cellspacing="0" cellpadding="0">
          <thead>
            <tr class="bg-light borde-1 border-light "  style="height: 40px;">
              <th width="2%" class="p-1"><input id="check_all"  type="checkbox" style="margin-left: 13px;"/></th>
              <th width="10%">Account</th>
              <th width="12%">Supplier</th>
              <th width="12%">Party</th>
              <th width="12%">Employee</th>
              <th width="10%">Narration</th>
              
              
              <th width="5%">Invoice</th>
              <th width="5%">Ref No</th>
              <th width="8%">Debit</th>
              <th width="8%">Credit</th>
            </tr>
          </thead>
          <tbody>
            <tr  class="bg-light border-1 border-light" >
              <td class=" bg-light border-1 border-light"><input class="case" type="checkbox" style="margin-left: 15px;" /></td>
              <td>

                 <select name="ChOfAcc[]" id="ItemID0_1" class="form-select select2 form-control-sm" >
                  <option value="">Select Account</option>
                  @foreach ($chartofaccount as $key => $value) 
                    <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                  @endforeach
                 </select>
               </td>
             
              <td> <select name="SupplierID[]" id="SupplierID_1" class=" select2  form-select " onchange="ajax_balance(this.value);">
                  <option value="">Select Supplier</option>

                   @foreach ($supplier as $key => $value) 
                    <option value="{{$value->SupplierID}}">{{$value->SupplierName}}</option>
                  @endforeach
                 </select>

                </td>
                 <td> <select name="PartyID[]" id="PartyID_1" class=" select2  form-select " onchange="ajax_balance(this.value);">
                  <option value="">Select Party</option>

                   @foreach ($party as $key => $value) 
                    <option value="{{$value->PartyID}}">{{$value->PartyName}}</option>
                  @endforeach
                 </select>

                </td>
                
                
                <td> <select name="EmployeeID[]" id="EmployeeID_1" class=" select2  form-select " onchange="ajax_balance(this.value);">
                  <option value="">Select Employee</option>

                   @foreach ($employee as $key => $value) 
                    <option value="{{$value->EmployeeID}}">{{$value->full_name}}</option>
                  @endforeach
                 </select>

                </td>

                <td>
                  <input type="text" name="Narration[]" id="RefNo_1" class="form-control      " autocomplete="off"   >
                </td>

                
             
              <td>
                <input type="number" name="Invoice[]" id="OPVAT_1" class=" form-control  " autocomplete="off" >
              </td>
              <td>
                <input type="number" name="RefNo[]" id="IPVAT_1" class=" form-control  " autocomplete="off"  >
              </td>
               
              
              
              
              <td>
                <input type="number" name="Debit[]" id="debit_1" class=" form-control changesNo totalLinePricee" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01"  >
              </td>
              <td>
                <input type="number" name="Credit[]" id="credit_1" class=" form-control changesNo totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" >
              </td>
            </tr>




 <tr  class="bg-light border-1 border-light" >
              <td class=" bg-light border-1 border-light"><input class="case" type="checkbox" style="margin-left: 15px;" /></td>
              <td>

                 <select name="ChOfAcc[]" id="ItemID0_2" class=" form-select select2 form-control-sm   ">
                  <option value="">Select Account</option>
                  @foreach ($chartofaccount as $key => $value) 
                    <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                  @endforeach
                 </select>
               </td>
             
              <td> <select name="SupplierID[]" id="SupplierID_2" class=" select2 form-select " onchange="ajax_balance(this.value);">
                  <option value="">Select Supplier</option>

                   @foreach ($supplier as $key => $value) 
                    <option value="{{$value->SupplierID}}">{{$value->SupplierName}}</option>
                  @endforeach
                 </select>

                </td>
                 <td> <select name="PartyID[]" id="PartyID_2" class=" select2 form-select " onchange="ajax_balance(this.value);">
                  <option value="">Select Party</option>

                   @foreach ($party as $key => $value) 
                    <option value="{{$value->PartyID}}">{{$value->PartyName}}</option>
                  @endforeach
                 </select>

                </td>
                
                
                <td> <select name="EmployeeID[]" id="EmployeeID_2" class=" select2 form-select " onchange="ajax_balance(this.value);">
                  <option value="">Select Employee</option>

                   @foreach ($employee as $key => $value) 
                    <option value="{{$value->EmployeeID}}">{{$value->full_name}}</option>
                  @endforeach
                 </select>
                 </select>

                </td>

                <td>
                  <input type="text" name="Narration[]" id="RefNo_2" class="form-control      " autocomplete="off"   >
                </td>

                
             
              <td>
                <input type="number" name="Invoice[]" id="OPVAT_2" class=" form-control  " autocomplete="off" >
              </td>
              <td>
                <input type="number" name="RefNo[]" id="IPVAT_2" class=" form-control  " autocomplete="off"  >
              </td>
               
              
              
              
              <td>
                <input type="number" name="Debit[]" id="debit_2" class=" form-control changesNo totalLinePricee" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01"  >
              </td>
              <td>
                <input type="number" name="Credit[]" id="credit_2" class=" form-control changesNo totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" >
              </td>
            </tr>



          </tbody>

            <tfooter>
            <tr class="bg-light border-1 border-light "  style="height: 40px;">
              <th width="2%" > </th>
              <th width="10%">  </th>
              <th width="10%">  </th>
              <th width="12%"> </th>
              <th width="10%"> </th>
              <th width="10%"> </th>
              
         
              <th width="5%" colspan="2"> TOTAL</th>
              <th width="5%"><input type="text"  readonly="" class=" form-control " id="sum_dr"> </th>
              <th width="5%"><input type="text" readonly="" class=" form-control " id="sum_cr"></th>
            </tr>


             <tr class="bg-light border-1 border-light "  style="height: 40px;">
              <th width="2%" > </th>
              <th width="10%">  </th>
              <th width="10%">  </th>
              <th width="12%"> </th>
              <th width="10%"> </th>
              <th width="10%"> </th>
              
         
              <th width="5%" colspan="2"> DIFFERENCE</th>
              <th width="5%" colspan="2"> <div  id="Difference"></div></th>
               
            </tr>
          </tfooter>


        </table>
          </div>
        </div>
        <div class="row mt-1 mb-2" style="margin-left: 29px;">
          <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  ' >
            <button class="btn btn-danger delete" type="button"><i class="bx bx-trash align-middle font-medium-3 me-25"></i>Delete</button>
            <button class="btn btn-success addmore" type="button"><i class="bx bx-list-plus align-middle font-medium-3 me-25"></i> Add More</button>

          </div>

           <div class='col-xs-5 col-sm-3 col-md-3 col-lg-3  ' >
          <div id="result"></div>

          </div>
          <br>
        
        </div>


        <div >


      
        </div>


        
         <div class="col-md-6"> <iframe src="{{URL('/Attachment')}}" width="100%" height="40%" border="0" scrolling="yes" style="overflow: hidden;"></iframe></div>
              
          
        
  <!--  <div class='row'>
          <div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
            <div class="well text-center">
          <h2>Back TO Tutorial: <a href="#"> Invoice System </a> </h2>
        </div>
          </div>
        </div>   -->
  
               
      
    </div>
     </div>
 </div>
 
      
         
       
     

<div class="card-footer bg-light"> <div  ><button type="submit" id="submit" class="btn btn-primary w-lg me-50 float-right">Save</button>
              <a href="{{URL('/Voucher')}}" class="btn btn-secondary w-lg float-right">Cancel</a>

       </div></div>

      </div>

      <!-- card end -->
  </div>
   </form>
  </div>
</div>

        </div> 
      </div>
    </div>
    <!-- END: Content-->

     <script src="{{asset('assets/invoice/js/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('assets/invoice/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/invoice/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/invoice/js/bootstrap-datepicker.js')}}"></script>
    <!-- <script src="js/ajax.js"></script> -->

    <script>
      
      /**
 * Site : http:www.smarttutorials.net
 * @author muni
 */
        
//adds extra table rows
var i=$('table tr').length;
$(".addmore").on('click',function(){
  html = '<tr class="bg-light border-1 border-light ">';
  html += '<td ><input class="case" type="checkbox" style="margin-left: 15px;" /></td>';
  html += '<td><select name="ChOfAcc[]" id="ItemID0_'+i+'" class=" select2 form-select changesNoo"> <option value="">Select Account</option> @foreach ($chartofaccount as $key => $value) <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>@endforeach</select> </td>';


  // html += '<td><select name="ItemID[]" id="ItemID_'+i+'" class="form-select changesNoo"><option value="">Select Item</option><option value="">b</option></select></td>';
  html += '<td><select name="SupplierID[]" id="SupplierID_'+i+'"  onchange="ajax_balance(this.value);" class="form-select select2 "> <option value="">Select Supplier</option>@foreach ($supplier as $key => $value) <option value="{{$value->SupplierID}}">{{$value->SupplierName}}</option>@endforeach</select></td>';
   
  html += '<td><select name="PartyID[]" id="PartyID_'+i+'" class="form-select select2" onchange="ajax_balance(this.value);"><option value="">Select PartyID</option>@foreach ($party as $key => $value)<option value="{{$value->PartyID}}">{{$value->PartyName}}</option>@endforeach</select></td>';

  html += '<td><select name="EmployeeID[]" id="EmployeeID_'+i+'" class="form-select select2" onchange="ajax_balance(this.value);" style="width: 100% !important;"><option value="">Select Employee</option>@foreach ($employee as $key => $value)<option value="{{$value->EmployeeID}}">{{$value->full_name}}</option>@endforeach</select></td>';


  
  html += '<td><input type="text" name="Narration[]" id="RefNo_'+i+'" class="form-control changesNo" ></td>';
 
   html += '<td><input type="text" name="Invoice[]" id="OPVAT_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
  html += '<td><input type="text" name="RefNo[]" id="IPVAT_'+i+'" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
  html += '<td><input type="number" name="Debit[]" id="debit_'+i+'" class=" form-control changesNo totalLinePricee" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01"  ></td>';
  html += '<td><input type="number" name="Credit[]" id="credit_'+i+'" class=" form-control changesNo totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" step="0.01" ></td>';
  html += '</tr>';
  $('table').append(html);
  $('.select2').select2();
  i++;
});

//to check all checkboxes
$(document).on('change','#check_all',function(){
  $('input[class=case]:checkbox').prop("checked", $(this).is(':checked'));
});

//deletes the selected table rows
$(".delete").on('click', function() {
  $('.case:checkbox:checked').parents("tr").remove();
  $('#check_all').prop("checked", false); 
  calculateTotal();
});


var prices = ["S10_1678|1969 Harley Davidson Ultimate Chopper|48.81","S10_1949|1952 Alpine Renault 1300|98.58"];

 
function round(value, decimals) {
    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
}
 
 


////////////////////////////////////////////

$(document).on('change keyup blur','.changesNo',function(){
  calculateTotal();
});

//total price calculation 
function calculateTotal(){

var sum_dr=0;
$.each($('.totalLinePricee'),function() {

   if ($(this).val().length == 0) {
  
   }
   else
   {
        sum_dr +=   round($(this).val(), 2)  ;  
   
   }



});

 //alert(sum);
  $("#sum_dr").val(sum_dr); // display in div in html


  var sum_cr=0;
$.each($('.totalLinePrice'),function() {

   if ($(this).val().length == 0) {
  
   }
   else
   {
        sum_cr +=  round($(this).val(), 2)  ;  
     
   }
});

 //alert(sum);
  $("#sum_cr").val(sum_cr); // display in div in html


    if (sum_dr!=sum_cr ) {
        // alert("Debit must be equal to Credit. Please check");
        $('#sum_dr').css("border", "1px dashed red");
        $('#sum_cr').css("border", "1px dashed red");

             }
             else

             {
               $('#sum_dr').css("border", "1px dashed green");
        $('#sum_cr').css("border", "1px dashed green");
             }

  
  
                    $('#Difference').html(sum_dr - sum_cr);
}




 

 


//It restrict the non-numbers
var specialKeys = new Array();
specialKeys.push(8,46); //Backspace
function IsNumeric(e) {
    var keyCode = e.which ? e.which : e.keyCode;
    console.log( keyCode );
    var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
    return ret;
}

//datepicker
$(function () {
  $.fn.datepicker.defaults.format = "dd-mm-yyyy";
    $('#invoiceDate').datepicker({
        startDate: '-3d',
        autoclose: true,
        clearBtn: true,
        todayHighlight: true
    });
});




    </script>

     <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

 <script>
   // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
 </script>

<!-- ajax trigger -->
 <script>
 

////////////////////////////////////////////
///voucher trigger

$(document).on('change','#InvoiceType1',function(){


  id_arr = $('#InvoiceType1').val();
 
  id = id_arr.split("-");

 // alert($('#VHNO').val());
  vhdate = $('#VHDate').val();
 
dm = vhdate.split("-");

// alert($('#ItemID0_'+id[1]).val());
$('#VoucherType').val( id[0]  );
$('#VoucherCode').val( id[1]+$('#Voucher').val()  );


ajax_vhno();
// val = $('#ItemID0_'+id[1]).val().split("|");



// alert($('#ItemID0_'+id[1]).val());
// $('#Taxable_'+id[1]).val( val[1]  );
// $('#ItemID_'+id[1]).val( val[0]  );
  
 

 
});


$(document).on('change','#VHDate',function(){

alert('dd');
  id_arr = $('#InvoiceType1').val();
 
  id = id_arr.split("-");

  vhdate = $('#VHDate').val();
 
dm = vhdate.split("-");
 
  ajax_vhno();

 
});
 
$(document).ready(function() {
     id_arr = $('#InvoiceType1').val();
 
  id = id_arr.split("-");

 // alert($('#VHNO').val());


// alert($('#ItemID0_'+id[1]).val());
$('#VoucherType').val( id[0]  );
$('#VoucherCode').val( id[1]+$('#Voucher').val()  );
}); 
   




   function ajax_balance(SupplierID) {
      
       // alert($("#csrf").val());
 
$('#result').prepend('')
$('#result').prepend('<img id="theImg" src="{{asset('assets/images/ajax.gif')}}" />')
 
       var SupplierID = SupplierID;

       // alert(SupplierID);
       if(SupplierID!=""  ){
        /*  $("#butsave").attr("disabled", "disabled"); */
        // alert(SupplierID);
          $.ajax({
              url: "{{URL('/Ajax_Balance')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                   SupplierID: SupplierID,
                 
              },
              cache: false,
              success: function(data){
            

              
                    $('#result').html(data);
           
                 
                  
              }
          });
      }
      else{
          alert('Please Select Branch');
      }

      
      

  }






// ajax vhno


function ajax_vhno()
{

       
       var VHDate = dm[0]+dm[1];


 
     // alert(id[1]+id[0]);
        
        /*  $("#butsave").attr("disabled", "disabled"); */
        // alert(SupplierID);
        
          $.ajax({
              url: "{{URL('/Ajax_VHNO')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                   VocherTypeID: id[0],
                   VocherCode: id[1],
                   VHDate: VHDate,
                 
              },
              cache: false,
              success: function(data){
            

              
                    $('#vhno_div').html(data);
    
              }
          });
      
}

function ajax_vhno1()
{

       // onload php date will work not boostrap picker
       var VHDate = {{date('Ym')}};


 
     // alert(id[1]+id[0]);
        
        /*  $("#butsave").attr("disabled", "disabled"); */
        // alert(SupplierID);
        
          $.ajax({
              url: "{{URL('/Ajax_VHNO')}}",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                   VocherTypeID: id[0],
                   VocherCode: id[1],
                   VHDate: VHDate,
                 
              },
              cache: false,
              success: function(data){
            

              
                    $('#vhno_div').html(data);
    
              }
          });
      
}

$(document).ready(function() {

   ajax_vhno1();
      

});


// end ajax vhno
 



$( "#submit" ).click(function() {   


// alert($('#sum_dr').val());
// alert($('#sum_cr').val());

 if (parseInt($('#sum_dr').val())!=parseInt($('#sum_cr').val()) ) {
        // alert("Debit must be equal to Credit. Please check");
        $('#sum_dr').css("border", "1px dashed red");
        $('#sum_cr').css("border", "1px dashed red");
        // this.value == '';
        /* or with jQuery: $(this).val(''); */
        Swal.fire({
  position: 'top-right',
  // icon: 'error',
  title: 'Debit must be equal to Credit. Please check',
  showConfirmButton: false,
  timer: 2000
})


        return false;

    }
});
  
 
</script>

 <script>
   $( document ).ready(function() {
    
  $('body').addClass('sidebar-enable vertical-collpsed')
 // $('body').removeClass('sidebar-enable vertical-collpsed')
//setTimeout(function(){
       //   $("body").removeClass("sidebar-enable vertical-collpsed");
     //},5000);
});

 </script>

 
 
<script src="{{asset('assets/js/scripts/forms/form-select2.min.js')}}"></script>
 


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <script src="{{asset('assets/js/scripts/forms/form-repeater.min.js')}}"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/js/core/app-menu.min.js')}}"></script>
    <script src="{{asset('assets/js/core/app.min.js')}}"></script>
    <script src="{{asset('assets/js/scripts/customizer.min.js')}}"></script>
    <!-- END: Theme JS-->
 
    <!-- BEGIN: Page JS-->
    <script src="{{asset('assets/js/scripts/pages/app-invoice.min.js')}}"></script>
    <!-- END: Page JS-->


  @endsection