@extends('template.tmp')

@section('title', 'HR')


@section('content')


    <style>
        /* Set width for all columns */
        .table th,
        .table td {
            white-space: nowrap;
            /* Prevent text from wrapping */
        }

        .table th:nth-child(1) {
            width: 250px !important;
        }

        .table th:nth-child(2) {
            width: 150px !important;
        }

        .table th:nth-child(3) {
            width: 150px !important;
        }
    </style>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Job Title</h4>

                            <div class="page-title-right">
                                <div class="page-title-right">
                                    <!-- button will appear here -->

                                    <a href="{{ URL('/Attendance') }}"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i
                                            class="mdi mdi-arrow-left me-1"></i> Go Back</a>

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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4"></h4>

                                {{-- <form action="{{URL('/AttendanceSave')}}" method="post"> --}}

                                <form id="create-update-form" name="create-update-form">

                                    @csrf

                                    <input type="hidden" name="JobID" class="form-control"
                                        value="{{ request()->jobid }}">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Entry Date</label>
                                                <input type="date" class="form-control form-control-sm" name="Date"
                                                    value="{{ date('Y-m-d') }}" style="width: 130px;" id="Date">
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Month Name</label>
                                                <input type="text" class="form-control form-control-sm" name="MonthName"
                                                    style="width: 130px;" readonly id="MonthName">
                                            </div>
                                        </div>

                                    </div>



                                    <!-- id="Date"  -->

                                    <div style="overflow-x: auto;">
                                        <table class="table table-bordered table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 250px !important;">S#</th>
                                                    <th style="width: 150px !important;">Employee</th>
                                                    <th style="width: 150px !important;">Designation</th>
                                                    <!-- Day columns (Day 01 to Day 31) -->
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <th style="width: 40px !important;">Day {{ $i }}</th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employee as $value)
                                                    <tr>
                                                        <td> {{ $value->EmployeeID }} <input type="hidden"
                                                                name="EmployeeID[]" value="{{ $value->EmployeeID }}"> </td>
                                                        <td> {{ $value->employee->full_name }} </td>
                                                        <td> {{ $value->employee->jobtitle->JobTitleName }} </td>

                                                        <!-- Day columns (Day 01 to Day 31) -->
                                                        @for ($i = 1; $i <= 31; $i++)
                                                            <td>
                                                                <input type="number" style="width: 40px;"
                                                                    name="Day{{ $i }}[]" pattern="[0-9]*"
                                                                    inputmode="decimal" value="1">
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>




                                    <div><button type="submit" id="submit-btn"
                                            class="btn btn-success w-sm float-right">Save</button>

                                    </div>


                            </div>









                            </form>


                        </div>
                        <!-- end card body -->
                    </div>


                </div>
                <!-- end col -->


            </div>
            <!-- end row -->








        </div> <!-- container-fluid -->
    </div>

    <script>
        $(document).ready(function() {
            // Function to update the Month Name input
            function updateMonthName(dateValue) {
                var date = new Date(dateValue); // Get the selected date from the input

                // Get the month name (short format) and year
                var monthName = date.toLocaleString('default', {
                    month: 'short'
                }); // 'Aug'
                var year = date.getFullYear(); // '2025'

                // Combine them in 'MMM-YYYY' format
                var formattedMonthName = monthName + '-' + year;

                // Set the Month Name in the input field
                $('#MonthName').val(formattedMonthName);
            }

            // Set the Month Name initially based on today's date
            updateMonthName($('#Date').val());

            // Update the Month Name when the Date input changes
            $('#Date').on('change', function() {
                updateMonthName(this.value);
            });


            $('#create-update-form').on('submit', function(e) {

                e.preventDefault();
                var btn = $('#submit-btn');


                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('attendance.save') }}",
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

                        $('#create-update-form')[0].reset(); // Reset all form data


                        notyf.success({
                            message: response.message,
                            duration: 3000
                        });
                        btn.prop('disabled', false);
                        btn.html('Create');

                        // Redirect after 3 seconds (3000ms)
                        setTimeout(function() {
                            window.location = "{{ route('attendance') }}";
                        }, 3000);


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



        });
    </script>

@endsection
