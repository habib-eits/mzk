@extends('tmp')

@section('title', $pagetitle)
 

@section('content')

 
 
 
  
 @if (session('error'))

 <div class="alert alert-{{ Session::get('class') }} p-1" id="success-alert">
                    
                   {{ Session::get('error') }}  
                </div>

@endif

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
<div class="main-content">

 <div class="page-content">
 <div class="container-fluid">




    <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">General Ledger</h4>
                                          
                                  

                                </div>
                            </div>
                        </div>

            
  <div class="card">
      <div class="card-body">
          <!-- enctype="multipart/form-data" -->
          <form action="{{URL('/StaffReport1')}}" method="post" name="form1" id="form1"> {{csrf_field()}} 

 
            
              

                <div class="col-md-4">
             <div class="mb-1">
                <label for="basicpill-firstname-input">Staff #</label>
                 <select name="EmployeeID" id="" class="select2 form-select" id="select2-basic">
                  <option value="">Select</option>
                 <?php foreach ($employee as $key => $value): ?>
                  <option value="{{$value->EmployeeID}}">{{$value->EmployeeID}}-{{$value->FullName}}</option>
                  
                <?php endforeach ?>
              </select>
              </div>
               </div>
            


            
               <div class="col-md-4">
             <div class="mb-1">
                <label for="basicpill-firstname-input">To Account #</label>
                 <select name="ChartOfAccountID" id="" class="select2 form-select" id="select2-basic">
                  <option value="">Select</option>
                 <?php foreach ($chartofaccount as $key => $value): ?>
                  <option value="{{$value->ChartOfAccountID}}">{{$value->ChartOfAccountID}}-{{$value->ChartOfAccountName}}</option>
                  
                <?php endforeach ?>
              </select>
              </div>
               </div>
            
            
 

             

                <div class="col-md-4"> 
                   <label class="col-form-label" for="email-id">From Date</label>
                 <div class="input-group" id="datepicker21">
  <input type="Date" name="StartDate"  value="{{date('Y-m-01')}}" class="form-control">
  
    </div>
              </div>

                <div class="col-md-4"> 
                   <label class="col-form-label" for="email-id">To Date</label>
               <div class="input-group" id="datepicker22">
<input type="Date" name="EndtDate"  value="{{date('Y-m-d')}}" class="form-control">
  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
    </div>
              </div>

              
              
         
      </div>
      <div class="card-footer bg-light">
        <button type="submit" class="btn btn-success w-lg float-right" id="online">Submit</button>
        <button type="submit" class="btn btn-success w-lg float-right" id="pdf">PDF</button>
                   <a href="{{URL('/')}}" class="btn btn-secondary w-lg float-right">Cancel</a>
      </div>
  </div>
   </form>
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->

 
  @endsection