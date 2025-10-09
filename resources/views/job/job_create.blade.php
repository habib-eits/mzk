@extends('tmp')

@section('title', 'Create Job')


@section('content')

    <script src="{{ URL('/assets/js/tinymce.min.js') }}"></script>


    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            toolbar: 'bold italic underline | bullist numlist indent outdent',
            branding: false,
            menubar: false,
        });
    </script>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Job Create</h4>

                            <div class="page-title-right">
                                <div class="page-title-right">
                                    <!-- button will appear here -->
                                    <a href="{{ URL('/Job') }}"
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

                                <!-- enctype="multipart/form-data" -->
                                <form action="{{ URL('/JobSave') }}" method="post">

                                    <input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}">



                                    <div class="row">



                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Branch <span
                                                        class="text-danger">*</span></label>
                                                <select name="BranchID" id="BranchID" class="form-select">
                                                    <?php foreach ($branch as $key => $value) : ?>
                                                    <option value="{{ $value->BranchID }}">{{ $value->BranchName }}</option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Job No <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="JobNo"
                                                    value="{{ old('JobNo') }}" required="" id="JobNo">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Job Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="JobDate" id="JobDate"
                                                    value="{{ date('Y-m-d') }}" required="">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Job Due Date <span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="JobDueDate" id="JobDueDate"
                                                    value="{{ date('Y-m-d') }}" required="">
                                            </div>
                                        </div>





                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Created For <span
                                                        class="text-danger">*</span></label>
                                                <select name="PartyID" id="PartyID" class="form-select select2"
                                                    required="">
                                                    <option value="">Select</option>

                                                    @foreach ($party as $value)
                                                        <option value="{{ $value->PartyID }}">{{ $value->PartyName }}
                                                        </option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Shift Type <span
                                                        class="text-danger">*</span></label>
                                                <select name="ShiftType" id="ShiftType" class="form-select">
                                                    <option value="Day">Day</option>
                                                    <option value="Night">Night</option>
                                                    <option value="Day & Night">Day/Night</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 d-none">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Qtn Reference <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="QtnReference"
                                                    id="QtnReference" value="{{ old('QtnReference') }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="verticalnav-address-input">Job Details</label>
                                                <textarea id="verticalnav-address-input" class="form-control" rows="" name="JobDetail">Job Details goes here</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Job Location <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="JobLocation"
                                                    value="{{ old('JobLocation') }}" required="" id="JobNo">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="basicpill-firstname-input">Status <span
                                                        class="text-danger">*</span></label>
                                                <select name="Status" id="Status" class="form-select">
                                                    <option value="1">Active</option>
                                                    <option value="0">Close</option>
                                                </select>
                                            </div>
                                        </div>



                                    </div>

                                    <div><button type="submit" class="btn btn-success w-lg float-right">Save</button>
                                        <a href="{{ URL('/Job') }}"
                                            class="btn btn-secondary w-lg float-right">Cancel</a>
                                    </div>





                                </form>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->


                </div>
                <!-- end row -->
                <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
                    crossorigin="anonymous"></script>

                <script>
                    $("#BranchID").change(function() {


                        var BranchID = $('#BranchID').val();

                        console.log(BranchID);
                        if (BranchID != "") {
                            /*  $("#butsave").attr("disabled", "disabled"); */
                            // alert('next stage if else');
                            // console.log(InvoiceType);

                            $.ajax({

                                url: "{{ URL('/ajax_invoice_vhno') }}",
                                type: "POST",
                                data: {
                                    // _token: p3WhH7hWcpfbcxtNskY1ZrCROfa3dpKp3MfEJwXu,
                                    "_token": $("#csrf").val(),
                                    BranchID: BranchID,
                                    InvoiceTyp: 'Job',

                                },
                                cache: false,

                                success: function(data) {

                                    // alert(data.vhno);
                                    $('#JobNo').val(data.vhno);



                                }
                            });
                        }


                    });
                </script>


                <script>
                    $(document).ready(function() {

                        var BranchID = $('#BranchID').val();

                        console.log(BranchID);
                        if (BranchID != "") {
                            /*  $("#butsave").attr("disabled", "disabled"); */
                            // alert('next stage if else');
                            // console.log(InvoiceType);

                            $.ajax({

                                url: "{{ URL('/ajax_invoice_vhno') }}",
                                type: "POST",
                                data: {
                                    // _token: p3WhH7hWcpfbcxtNskY1ZrCROfa3dpKp3MfEJwXu,
                                    "_token": $("#csrf").val(),
                                    BranchID: BranchID,
                                    InvoiceTyp: 'Job',

                                },
                                cache: false,

                                success: function(data) {

                                    // alert(data.vhno);
                                    $('#JobNo').val(data.vhno);



                                }
                            });
                        }

                    });
                </script>






            </div> <!-- container-fluid -->
        </div>
        <script>
            document.getElementById("JobDate").addEventListener("change", function() {
                let jobDate = this.value;
                let jobDueDate = document.getElementById("JobDueDate");

                jobDueDate.min = jobDate; // Set the minimum date to JobDate
                if (jobDueDate.value < jobDate) {
                    jobDueDate.value = jobDate; // Adjust JobDueDate if it's before JobDate
                }

                updateDateDifference();

            });
        </script>


        <script>
            function updateDateDifference() {
                let jobDate = document.getElementById("JobDate").value;
                let jobDueDate = document.getElementById("JobDueDate").value;
                let qtnReference = document.getElementById("QtnReference");

                if (jobDate && jobDueDate) {
                    let startDate = new Date(jobDate);
                    let endDate = new Date(jobDueDate);
                    let timeDiff = endDate - startDate;
                    let dayDiff = timeDiff / (1000 * 60 * 60 * 24); // Convert milliseconds to days

                    qtnReference.value = dayDiff + " Days"; // Update QtnReference field
                }
            }
        </script>

        <script>
            document.getElementById("JobDueDate").addEventListener("change", function() {
                let jobDate = document.getElementById("JobDate").value;
                let jobDueDate = this.value;
                let qtnReference = document.getElementById("QtnReference");

                if (jobDate && jobDueDate) {
                    let startDate = new Date(jobDate);
                    let endDate = new Date(jobDueDate);
                    let timeDiff = endDate - startDate;
                    let dayDiff = timeDiff / (1000 * 60 * 60 * 24); // Convert milliseconds to days

                    qtnReference.value = dayDiff + " Days"; // Update the QtnReference field
                }
            });
        </script>


    @endsection
