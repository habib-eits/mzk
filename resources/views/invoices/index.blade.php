@extends('template.tmp')
@section('title', '')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-sm-0 font-size-18">Invoice</h3>

                            {{-- <div class="page-title-right d-flex">

                                <div class="page-btn">
                                    <a href="{{ route('invoice.create') }}" class="btn btn-added btn-primary">
                                        <i class="me-2 bx bx-plus"></i>Add
                                    </a>
                                </div>
                            </div> --}}



                        </div>
                    </div>
                </div>
                <div class="card">


                    <div class="card-body">
                        <table id="table" class="table table-striped table-sm " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Party</th>
                                    <th>Project Name</th>
                                    <th>Ref Quo#</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Grand Total</th>

                                    <th>Action</th>
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
                ajax: "{{ route('invoice.index') }}",
                columns: [
                    {
                        data: 'InvoiceMasterID'
                    },
                    {
                        data: 'InvoiceNo'
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
                        data: 'reference_quotation_no'
                    },
                    {
                        data: 'SubTotal'
                    },
                    {
                        data: 'Tax'
                    },
                    {
                        data: 'GrandTotal'
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
    </script>
@endsection
