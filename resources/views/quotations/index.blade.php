@extends('template.tmp')
@section('title', '')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0 font-size-18">Quotation</h3>

                            <div class="page-title-right d-flex">

                                <div class="page-btn">
                                    <a href="{{ route('quotation.create') }}" class="btn btn-added btn-primary">
                                        <i class="me-2 bx bx-plus"></i>Add
                                    </a>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="card">


                    <div class="card-body">
                        <table id="table" class="table table-striped table-sm " style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 15%">Date</th>
                                    <th style="width: 15%">Party</th>
                                    <th style="width: 25%">Project Name</th>
                                    <th style="width: 25%">Status</th>

                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('quotation.index') }}",
                columns: [{
                        data: 'InvoiceMasterID'
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'party_name'
                    },
                    {
                        data: 'ProjectName'
                    },
                    {
                        data: 'Status'
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


        function createSaleInvoiceFromQuotation(quotationId) {
            if (confirm('Are you sure you want to create a Sale Invoice from this Quotation?')) {
                $.ajax({
                    url: "{{ route('create-sale-invoice-from-quotation', ':quotationId') }}".replace(':quotationId',
                        quotationId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {

                        notyf.success({
                            message: response.message,
                            duration: 3000
                        });

                        setTimeout(function() {
                            window.location.href = "{{ route('invoice.edit', ':id') }}".replace(':id',
                                response.InvoiceMasterID);
                        }, 1500);

                    },
                    error: function(e) {

                        notyf.error({
                            message: e.responseJSON.message,
                            duration: 5000
                        });
                    }
                });
            }
        }
    </script>
@endsection
