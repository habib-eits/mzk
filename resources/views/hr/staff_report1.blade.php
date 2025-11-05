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
   <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Staff Report</h4>
                                        <strong class="text-end"></strong> 
        From {{request()->StartDate}} TO {{request()->EndDate}}

                                </div>
                            </div>
                        </div>

<div class="row">
  <div class="col-12">
  
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

            
            <?php 
            $DrTotal=0;
            $CrTotal=0;
             ?>
  <div class="card">
      <div class="card-body">
           @if(count($journal)>0)    
          <table class="table table-sm table-bordered  table-striped align-middle table-nowrap mb-0">
          <tbody><tr>
          <th class="col-md-1 text-center">Emp ID</th>
          <th class="col-md-1 text-center" >Full Name</th>
          <th class="col-md-2 text-center">AC</th>
          <th class="col-md-4 text-center">Description</th>
          <th class="col-md-1 text-center">DEBIT</th>
          <th class="col-md-1 text-center">CREDIT</th>
          <th class="col-md-1 text-center">Balance</th>
            </tr>
          </tbody>
          <tbody>
            <tr></tr>
            <td></td>
            <td></td>
            <td></td>
            <td>By Balance Brought Forward</td>
            <td></td>
            <td></td>
            <td class="text-danger text-end"></td>
         
          @foreach ($journal as $key =>$value)
           <tr>
           <td class="text-center"><a href="{{ route('staff.report.detail',['employee_id' => $value->EmployeeID, 'chartofaccountid' => $value->ChartOfAccountID ]) }}" target="_blank">{{$value->EmployeeID}}</a></td>
           <td class="text-left"><a href="{{ route('staff.report.detail',['employee_id' => $value->EmployeeID, 'chartofaccountid' => $value->ChartOfAccountID ]) }}" target="_blank">{{$value->FullName}}</a></td>
           
           <td class="text-left">{{$value->ChartOfAccountName}}</td>
           <td ></td>
           <td class="text-end"><div> {{($value->TotalDr==0) ? '' : number_format($value->TotalDr,2)}}</div></td>
           <td class="text-end"><div> {{($value->TotalCr==0) ? '' : number_format($value->TotalCr,2)}}</div></td>
              <td class="text-end">
               

                @php
                $balance=$value->TotalDr-$value->TotalCr;
                @endphp
                {{number_format($balance,2)}}
              </td>
           
           </tr>
           @endforeach   
   
           </tbody>
           </table>
           @else
             <p class=" text-danger">No data found</p>
           @endif   
      </div>
  </div>
  
  </div>
</div>

        </div>
      </div>
    </div>
    <!-- END: Content-->
<!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->
  @endsection