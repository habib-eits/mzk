@extends('template.tmp')

@section('title', $pagetitle)
 

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18"> Salary Detail</h4>

                                    <div class="page-title-right ">
                                        <div class="page-title-right text-danger">
                                         <!-- button will appear here -->[{{session::get('MonthName')}}]  <a href="{{URL('/SalaryPrint/'.session::get('MonthName').'/'.session::get('BranchID'))}}" target="_blank" class="shadow-sm btn btn-success btn-rounded w-sm"><i class="mdi mdi-printer me-2"></i>Print</a>

                                         
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                 @if (session('error'))

<div class="alert alert-{{ Session::get('class') }} p-3">
                    
                  <strong>{{ Session::get('error') }} </strong>
                </div>

@endif

  @if (count($errors) > 0)
                                 
                            <div >
                <div class="alert alert-danger pt-3 pl-0   border-3 bg-danger text-white">
                   <p class="font-weight-bold"> There were some problems with your input.</p>
                    <ul>
                        
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>

                        @endforeach
                    </ul>
                </div>
                </div>

            @endif
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"> </h4>

                                      <form method="POST" name="SalaryForm" id="SalaryForm">
      @csrf
                                          <table   class="table table-sm table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 1247px;">
                                        <thead>
                                                        <tr class="bg-light ">
                                                    <th style="width: 4% !important;">S.No</th>
                                                     <th style="width: 10% !important;">Employee Name</th>
                                                    <th style="width: 10% !important;">Job Title </th>
                                                    <th style="width: 2% !important;">MR</th>
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
                                                     <th style="width: 25% !important;">Notes</th>
                                                     
                                                   </tr>
                                                </thead>
        
        
                                            <tbody>
                                            
                                            	<?php foreach ($salary as $key => $value): ?>
                @php
                    
                    $no = $key + 1;
                @endphp                             
                                      <tr>
                                        


         <td >{{$key+1}}     </td>
      
        <td>{{$value->EmployeeName}} ({{$value->EmployeeID}}) </td>
        <td>{{$value->JobTitle}}</td>
        <td>168000</td>

        <td><input type="hidden" name="SalaryID[]" id="SalaryID_{{$no}}" value="{{$value->SalaryID}}">
            <input type="text" size="2" name="DaysPresent[]" id="DaysPresent_{{$no}}" value="{{$value->DaysPresent}}" class="changesNo"  ></td>

         <td><input type="number" step="0.01" size="2" name="PerDay[]" id="PerDay_{{$no}}" value="{{$value->PerDay}}" class="changesNo" style="width: 80px;"></td>

        <td><input type="number" step="0.01" size="2" name="Salary[]" id="Salary_{{$no}}" value="{{$value->Salary}}" class="changesNo" style="width: 80px;" readonly="" ></td>

        <td><input type="number" step="0.01" size="2" name="OT[]" id="OT_{{$no}}" value="{{$value->OT}}" class="changesNo" style="width: 80px;"></td>
        
        <td><input type="number" step="0.01" size="2" name="Commission[]" id="Commission_{{$no}}" value="{{$value->Commission}}" class="changesNo" style="width: 80px;"></td>

        <td><input type="number" step="0.01" size="2" name="Advance[]" id="Advance_{{$no}}" value="{{$value->Advance}}" class="changesNo" style="width: 80px;"></td>
        <td><input type="number" step="0.01" size="2" name="Visa_deduction[]" id="VisaDeduction_{{$no}}" value="{{$value->Visa_deduction}}" class="changesNo" style="width: 80px;"></td>

        <td><input type="number" step="0.01" size="2" name="SD[]" id="SD_{{$no}}" value="{{$value->SD}}" class="changesNo" style="width: 80px;"></td>

        <td><input type="number" step="0.01" size="2" name="training_deduction[]" id="trainingDeduction_{{$no}}" value="{{$value->training_deduction}}" class="changesNo" style="width: 80px;"></td>
        
        <td><input type="number" step="0.01" size="2" name="salary_deduction[]" id="salaryDeduction_{{$no}}" value="{{$value->salary_deduction}}" class="changesNo" style="width: 80px;"></td>

        <td><input type="number" step="0.01" size="2" name="NetSalary[]" id="NetSalary_{{$no}}" value="{{$value->NetSalary}}"  style="width: 80px;" readonly=""></td>
      
        <td><input type="text" name="Notes[]" id="Notes_{{$no}}" value="{{$value->Notes ?? ''}}" style="width: 100%;"></td>

                                                        <td >

                                                          </td>
                                                     </tr>
                                                
                                                <?php endforeach ?>

           <tr>
            <td colspan="3"><button type="submit" value="Update Notes" class="btn btn-success" id="SalaryFormButton">Update Notes</button>  </td></tr>                                   

                                           
                                        </tbody>
                                        </table>

                                        

                                      </form>
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
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script>
    // Create an instance of Notyf
    let notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'right',
            y: 'top',
        },
    });
</script>
<script>
         $('#SalaryForm').on('submit', function(e) {

                e.preventDefault();
                var btn = $('#SalaryFormButton');
                

                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('salary.update') }}",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: formData,
                    enctype: "multipart/form-data",
                    beforeSend: function() {
                        btn.prop('disabled', true);
                        btn.html('Processing');
                    },
                    success: function(response) {

                       
 
                        notyf.success({
                            message: response.message,
                            duration: 3000
                        });
                        btn.prop('disabled', false);
                        btn.html('Update Notes');

                        // setTimeout(function() {
                        //     window.location.href = "/";
                        // }, 2000);


                    },
                    error: function(e) {
                        btn.prop('disabled', false);
                        btn.html('Create');
                        notyf.error({
                            message: e.responseJSON.message,
                            duration: 5000
                        });
                    }
                });
            });
</script>

  @endsection