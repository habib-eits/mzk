@extends('template.tmp')

@section('title', 'HR')
 

@section('content')
 
 <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Attendance </h4>

                                    {{request()->Date}}

                                    <div class="page-title-right">
                                        <div class="page-title-right">
                                          <a href="{{URL('/Attendance')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="mdi mdi-arrow-left me-1"></i> Go Back</a>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                 
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4"></h4>

 <h5>Site : {{$attendance_master->job->JobNo}} </h5>
 <h5>Location : {{$attendance_master->job->JobLocation}} </h5>
 <h5>{{$attendance_master->MonthName}} </h5>

 <br>
 <br>
                                        
 @if(count($attendance)>0)        
<table class="table table-bordered table-sm align-middle  mb-0">
<thead><tr>
<th width="15">S.No</th>
<th width="450">Employee </th>
{{-- <th width="150">Designation</th> --}}
  @for ($day = 1; $day <= 31; $day++)
                <th width="75">{{ $day }}</th>
            @endfor
 
</tr>
</thead>
<tbody>
@foreach ($attendance as $key =>$value)
 <tr>
 <td >{{$key+1}}</td>
 <td >{{$value->employee->full_name}}</td>
 {{-- <td >{{$value->employee->jobtitle->JobTitleName}}</td> --}}
   @for ($day = 1; $day <= 31; $day++)
                    @php
                        $field = 'Day' . $day;
                    @endphp
                    <td>{{ $value->$field }}</td>
                @endfor
 
 </tr>
 @endforeach   
 </tbody>
 </table>
 @else
   <p class=" text-danger">No data found</p>
 @endif   
                                        
                                    </div>
                                    <!-- end card body -->

                                    
                                </div> 

                        
                            </div>
                            <!-- end col -->

                           
                        </div>
                        <!-- end row -->


                       
 
                         
                     
                        
                    </div> <!-- container-fluid -->
                </div>


  @endsection