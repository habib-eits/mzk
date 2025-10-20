@extends('template.tmp')
@section('title', 'Services')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0 font-size-18">All Services</h3>

                            <div class="page-title-right d-flex">

                                <div class="page-btn">
                                    <a href="#" class="btn btn-added btn-primary" onclick="addRecord()">
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
                                            <th width="6%">ID</th>
                                            <th width="84%">Name</th>
                                            <th width="84%">Status</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- General Modal for Create/Edit -->
                <div class="table-responsivee">
                    <div class="modal fade" id="create-update-modal">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">

                                <div class="modal-header border-0 custom-modal-header">
                                    <div class="page-title">
                                        <h4 id="modal-title"></h4> <!-- Dynamic Title -->
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body custom-modal-body">
                                    <form id="create-update-form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" id="record-id"> <!-- Used for Edit -->

                                        <div class="row">
                                            <div class="clearfix"></div>
                                            <div class="col-md-12 mb-1">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>

                                            <div class="col-md-12 mb-1">
                                                <label class="form-label">Status </label>
                                                <select name="is_active" id="is_active" class="form-select">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
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

            </div>
        </div>
    </div>

    <script>
        var table = null;
        $(document).ready(function() {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('service-type.index') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'is_active',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge bg-success">Active</span>';
                            } else {
                                return '<span class="badge bg-danger">Inactive</span>';
                            }
                        }
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

                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('service-type.store') }}",
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
            $('#create-update-modal').modal('show');
        }

        function editRecord(id) {
            var btn = $('#submit-btn');
            $.get("{{ route('service-type.edit', ':id') }}".replace(':id', id), function(response) {
                $('#record-id').val(response.data.id);
                $('#name').val(response.data.name);
                $('#is_active').val(response.data.is_active);


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
                    url: "{{ route('service-type.destroy', ':id') }}".replace(':id', id),
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



@endsection
