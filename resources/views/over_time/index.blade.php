@extends('template.tmp')

@section('title', 'Sector')

@section('content')
ddd



    @if (session('flash-danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('flash-danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">



    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h3 class="mb-sm-0 font-size-18">All {{ $title }}</h3>

                <div class="page-title-right d-flex">

                    <div class="page-btn">
                        <a href="#" class="btn btn-added btn-success btn-rounded w-md" onclick="addRecord()">
                            <i class="me-2 bx bx-plus"></i>Add
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-striped table-sm " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th width="15%">Job</th>
                                            <th width="20%">Site Location</th>
                                            <th width="20%">Guard Name</th>
                                            
                                            <th width="8%">Month</th>
                                            <th width="8%">Date</th>
                                            <th width="5%">Hours</th>
                                            <th width="5%">Rate</th>
                                            <th width="5%">Amount</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
</div>
</div>

    <!-- General Modal for Create/Edit -->
    <div class="table-responsivee">
        <div class="modal fade" id="create-update-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header border-0 custom-modal-header">
                        <div class="page-title">
                            <h4 id="modal-title"></h4> <!-- Dynamic Title -->
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <form id="create-update-form" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="record-id"> <!-- Used for Edit -->

                            <div class="row">

                          
                                
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Site</label>
                                    <select name="JobID" id="JobID" class="form-select select2 " style="width: 100%;" >
                                        @foreach ($job as $item)
                                        <option value="{{$item->JobID}}">{{$item->JobNo}}-{{$item->JobLocation}}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Guard Name</label>
                                    <select name="EmployeeID" id="EmployeeID" class="form-select select2 " style="width: 100%;" >
                                        @foreach ($employee as $row)
                                        <option value="{{$row->EmployeeID}}">{{$row->FirstName}} {{$row->MiddleName}} {{$row->LastName}}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>

                                      <div class="col-md-6 mb-1">
                                    <label class="form-label">Date</label>
                                    <input type="date" name="Date" value="{{date('Y-m-d')}}" class="form-control" id="Date">
                                </div>
                                
                                
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Month</label>
                                    <input type="text" name="MonthName"  class="form-control" id="MonthName"  readonly>
                                </div>

                      

                                   <div class="col-md-2 mb-1">
                                    <label class="form-label">Extra Hours</label>
                                    <input type="decimal" name="extra_hours"  class="form-control" id="extra_hours" >
                                </div>
                                
                                <div class="col-md-2 mb-1">
                                    <label class="form-label">Fix Rate</label>
                                    <input type="decimal" name="FixRate"  class="form-control" id="FixRate"  value="0">
                                </div>
                                
                                
                                <div class="col-md-2 mb-1">
                                    <label class="form-label">Total</label>
                                    <input type="decimal" name="Total"  class="form-control" id="Total" readonly>
                                </div>
                                
                                
                    

                            </div>

                            <div class="modal-footer-btn mt-3">
                                <button type="button" class="btn btn-cancel me-2 btn-dark"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="submit-btn" class="btn btn-submit btn-primary">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        var table = null;
        $(document).ready(function() {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('overtime.index') }}",
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
                    },
                    
                    {
                        data: 'employee_full_name',
                        name: 'employee_full_name'
                    },
                    
                                  
                
                    {
                        data: 'MonthName'
                    },
                    
                    {
                        data: 'Date'
                    },
                    
                    {
                        data: 'extra_hours'
                    },
                    
                    {
                        data: 'FixRate'
                    },
                    
                    {
                        data: 'Total'
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


            $('#create-update-form').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#submit-btn');
                tinymce.triggerSave(); // Important: sync content

                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('overtime.store') }}",
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

                        $('#create-update-modal').modal('hide');
                        $('#create-update-form')[0].reset(); // Reset all form data
                        table.ajax.reload();

                        notyf.success({
                            message: response.message,
                            duration: 3000
                        });
                        btn.prop('disabled', false);
                        btn.html('Create');
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

        // Handle the delete button click
        function addRecord() {
            $('#modal-title').text('Create');
            $('#record-id').val(''); // Clear the hidden input
            $('#submit-btn').text('Create');
            updateMonthName();
            $('#create-update-modal').modal('show');
        }

        function editRecord(id) {
            var btn = $('#submit-btn');
            $.get("{{ route('overtime.edit', ':id') }}".replace(':id', id), function(response) {
                $('#record-id').val(response.data.id);
                $('#JobID').val(response.data.JobID);
                $('#EmployeeID').val(response.data.EmployeeID);
                $('#Date').val(response.data.Date);
                $('#MonthName').val(response.data.MonthName);
                $('#extra_hours').val(response.data.extra_hours);
                $('#FixRate').val(response.data.FixRate);
                $('#Total').val(response.data.Total);

                $('#modal-title').text('Update');
                $('#submit-btn').text('Update');

                $('#create-update-modal').modal('show');
            }).fail(function(xhr) {

                notyf.error({
                    message: xhr.responseJSON.message,
                    duration: 5000
                });
                // alert('Error fetching brand details: ' + xhr.responseText);
            });
        }

        function deleteRecord(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('overtime.destroy', ':id') }}".replace(':id', id),
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

    <script src="{{ URL('/assets/js/tinymce.min.js') }}"></script>
    <script id="rendered-js">
        tinymce.init({
            selector: "textarea:not(.kashif)", // Select all textarea exluding the mceNoEditor class
            height: 200,
            menubar: false,
            paste_data_images: true, // ✅ Allow image pasting
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            mobile: {
                theme: 'mobile'
            },
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
        });
        //# sourceURL=pen.js
    </script>

<script>
    function updateMonthName() {
        const dateValue = $('#Date').val();
        const selectedDate = new Date(dateValue);
        if (!isNaN(selectedDate)) {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const month = monthNames[selectedDate.getMonth()];
            const year = selectedDate.getFullYear();
            $('#MonthName').val(`${month}-${year}`);
        } else {
            $('#MonthName').val('');
        }
    }

    $(document).ready(function () {
        // When the date input changes
        $('#Date').on('change', updateMonthName);

        // Initial call on page load
        updateMonthName();
    });

  
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    function calculateTotal() {
        const extraHours = parseFloat($('#extra_hours').val()) || 0;
        const fixRate = parseFloat($('#FixRate').val()) || 0;
        const total = extraHours * fixRate;
        $('#Total').val(total.toFixed(2));
    }

    $('#extra_hours, #FixRate').on('input', calculateTotal);
});
</script>

</script>

@endsection
