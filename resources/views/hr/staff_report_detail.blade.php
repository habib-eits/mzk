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
                                    <h4 class="mb-sm-0 font-size-18">Staff Detail Report</h4>
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
       <table class="table table-sm table-bordered table-striped align-middle table-nowrap mb-0">
    <thead>
        <tr>
            <th class="col-md-1 text-center">Emp ID</th>
            <th class="col-md-1 text-center">Date</th>
            <th class="col-md-1 text-center">Full Name</th>
            <th class="col-md-2 text-center">AC</th>
            <th class="col-md-4 text-center">Description</th>
            <th class="col-md-1 text-center">DEBIT</th>
            <th class="col-md-1 text-center">CREDIT</th>
            <th class="col-md-1 text-center">Balance</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>By Balance Brought Forward</td>
            <td></td>
            <td></td>
            <td class="text-danger text-end"></td>
        </tr>

        @php
            $totalDr = 0;
            $totalCr = 0;
            $runningBalance = 0;
        @endphp

        @foreach ($journal as $key => $value)
            @php
                $totalDr += $value->Dr;
                $totalCr += $value->Cr;
                $balance = $value->Dr - $value->Cr;
                $runningBalance += $balance;
            @endphp

            <tr>
                <td class="text-center">{{ $value->EmployeeID }}</td>
                <td class="text-center"> {{ dateformatman2($value->Date) }}</td>
                <td class="text-center">{{ $value->FullName }}</td>
                <td class="text-left">{{ $value->ChartOfAccountName }}</td>
                <td></td>
                <td class="text-end">{{ $value->Dr == 0 ? '' : number_format($value->Dr, 2) }}</td>
                <td class="text-end">{{ $value->Cr == 0 ? '' : number_format($value->Cr, 2) }}</td>
                <td class="text-end">{{ number_format($runningBalance, 2) }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr class="fw-bold bg-light">
            <td colspan="5" class="text-end">TOTAL</td>
            <td class="text-end">{{ number_format($totalDr, 2) }}</td>
            <td class="text-end">{{ number_format($totalCr, 2) }}</td>
            <td class="text-end">{{ number_format($totalDr - $totalCr, 2) }}</td>
        </tr>
    </tfoot>
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