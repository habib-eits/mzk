@extends('template.tmp')
@section('title', $title)
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0 font-size-18">All {{ $title }}</h3>

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
                                            <th>ID</th>
                                            <th>Name</th>
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


    <!-- General Modal for Create/Edit -->
    <div class="modal fade" id="create-update-modal">
        <div class="modal-dialog custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4 id="modal-title"></h4> <!-- Dynamic Title -->
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form id="create-update-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="UnitID" id="UnitID"> <!-- Used for Edit -->

                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="UnitName" id="UnitName" class="form-control">
                                </div>

                                <div class="modal-footer-btn">
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

    <script>
        let routeName = @json($routeName);

        var table = null;
        $(document).ready(function() {
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('unit.index') }}",
                columns: [{
                        data: 'UnitID'
                    },
                    {
                        data: 'UnitName'
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
                let formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('unit.store') }}",
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: formData,
                    enctype: "multipart/form-data",

                    success: function(response) {

                        $('#create-update-modal').modal('hide');
                        $('#create-update-form')[0].reset(); // Reset all form data
                        table.ajax.reload();

                        notyf.success({
                            message: response.message,
                            duration: 3000
                        });
                    },
                    error: function(e) {

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
            $('#UnitID').val(''); // Clear the hidden input
            $('#submit-btn').text('Create');
            $('#create-update-modal').modal('show');
        }

        function editRecord(id) {
            $.get("{{ route('unit.edit', ':id') }}".replace(':id', id), function(response) {
                $('#UnitID').val(response.UnitID);
                $('#UnitName').val(response.UnitName);

                $('#modal-title').text('Update');
                $('#submit-btn').text('Update');
                $('#create-update-modal').modal('show');
            }).fail(function(xhr) {
                alert('Error fetching brand details: ' + xhr.responseText);
            });
        }

        function deleteRecord(id) {
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    type: 'DELETE',
                    url: "{{ route('unit.destroy', ':id') }}".replace(':id', id),
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
