@extends('template.tmp')

@section('title', 'HR')


@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Attendance</h4>

                            <div class="page-title-right">
                                <div class="page-title-right">
                                    <!-- button will appear here -->

{{-- 
                                    <a href="{{ URL('/AttendanceCreate') }}"
                                        class="btn btn-success btn-rounded waves-effect waves-light  me-2"><i
                                            class="mdi mdi-plus me-1"></i> New Attendance</a> --}}

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-12">



                        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
                        <script>
                            @if (Session::has('error'))
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                Command: toastr["{{session('class')}}"]("{{ session('error') }}")
                            @endif
                        </script>

                        @if (count($errors) > 0)

                            <div>
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



                        <div class="row">
                            @foreach ($job as $item)
                                
                            
                            <div class="col-md-3">
                                <div class="card shadow-sm" style="height: 120px;">
                                    <div class="card-body">
                                      <a href="{{route('attendance.create',['jobid' => $item->JobID])}}"> {{$item->JobNo}}<br>
                                       {{$item->JobLocation}}<br>
                                       <strong>{{$item->ShiftType}}</strong></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>


                        <div class="card">
                            <div class="card-body">

                                <table id="table" class="table table-striped table-sm " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="15%">Job</th>
                                            <th width="20%">Site Location</th>
                                            <th width="20%">Shift Type</th>
                                            <th width="20%">Month Name</th>
                                            <th width="20%">Date</th>



                                            <th>Action</th>
                                        </tr>
                                    </thead>
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

        <script>
            var table = null;
            $(document).ready(function() {
                table = $('#table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('ajax.attendance') }}",
                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },


                        {
                            data: 'job.JobNo'
                        },
                        {
                            data: 'job.JobLocation'
                        }, {
                            data: 'job.ShiftType'
                        },

                        {
                            data: 'MonthName'

                        },
 {
                            data: 'Date'

                        },


                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ],
                });




            });

function view_attendance(MonthName, JobID) {
    alert(MonthName+JobID);
    console.log(MonthName, JobID);

    let url = "{{ route('attendance.view', [':month', ':job']) }}";
    url = url.replace(':month', MonthName).replace(':job', JobID);
    window.location.href = url;
}

                    function deleteRecord(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('attendance.delete', ':id') }}".replace(':id', id),
                    data: {
                        _token: "{{ csrf_token() }}" // CSRF token for Laravel
                    },
                    success: function(response) {
                        table.ajax.reload();
                        notyf.success({
                            message: response.message,
                            duration: 3000
                        });
                    },
                    error: function(e) {
                        notyf.error({
                            message: e.responseJSON?.message || 'An error occurred.',
                            duration: 5000
                        });
                    }
                });
            }
        }



        </script>


        <script>
            $("#success-alert").fadeTo(4000, 500).slideUp(100, function() {
                // $("#success-alert").slideUp(500);
                $("#success-alert").alert('close');
            });
        </script>

    @endsection
