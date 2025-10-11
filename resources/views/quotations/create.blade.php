@extends('template.tmp')
@section('title', '')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <form id="create-update-form">
                    @csrf
                    <input type="hidden" name="InvoiceMasterID" value="{{ $quotation->InvoiceMasterID }}">
                    <div class="row">
                        {{-- left side --}}
                        <div class="col-md-8">

                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Customer</label>
                                <div class="col-md-4">
                                    <select name="PartyID" class="form-select select2 mt-5" style="width:100%;">
                                        <option value="">Select</option>
                                        @foreach ($parties as $party)
                                            <option value="{{ $party->PartyID }}"
                                                {{ $quotation->PartyID == $party->PartyID ? 'selected' : '' }}>
                                                {{ $party->PartyName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Attension</label>
                                <div class="col-md-8">
                                    <input type="text" name="Attension" class="form-control"
                                        value="{{ $quotation->Attension }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Subject</label>
                                <div class="col-md-8">
                                    <input type="text" name="Subject" class="form-control"
                                        value="{{ $quotation->Subject }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Project Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="ProjectName" class="form-control"
                                        value="{{ $quotation->ProjectName }}">
                                </div>
                            </div>



                        </div>


                        {{-- right side --}}
                        <div class="col-md-4">

                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Reference No</label>
                                <div class="col-md-8">
                                    <input type="text" name="ReferenceNo" class="form-control"
                                        value="{{ old('ReferenceNo', $quotation->ReferenceNo) }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Quotation Date</label>
                                <div class="col-md-8">
                                    <input type="date" name="Date" class="form-control"
                                        value="{{ $quotation->Date != null ? $quotation->Date : date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Quotation Expiry</label>
                                <div class="col-md-8">
                                    <input type="date" name="DueDate" class="form-control"
                                        value="{{ $quotation->DueDate != null ? $quotation->DueDate : date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Tender No</label>
                                <div class="col-md-8">
                                    <input type="text" name="TenderNo" class="form-control"
                                        value="{{ $quotation->TenderNo }}">
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="row col-md-9">
                        <table id="table">
                            <thead>
                                <tr>
                                    <th style="width: 10%">#</th>
                                    <th style="width: 60%">Work Description</th>
                                    <th style="width: 15%">Unit</th>
                                    <th style="width: 15%">Rate</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($quotation->details as $detail)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <select name="ItemID[]" class="form-control select2" style="width: 100%">
                                                <option value="">Select</option>
                                                @foreach ($items as $item)
                                                    <option {{ $item->ItemID == $detail->ItemID ? 'selected' : '' }}
                                                        value="{{ $item->ItemID }}">{{ $item->ItemName }}</option>
                                                @endforeach
                                            </select>

                                            <textarea name="Description[]" class="form-control mt-1">{{ $detail->Description }}</textarea>
                                        </td>
                                        <td>
                                            <select name="UnitName[]" class="form-select form-control-sm select2"
                                                style="width: 100%">
                                                <option value="">Select</option>
                                                @foreach ($units as $unit)
                                                    <option {{ $unit->UnitName == $detail->UnitName ? 'selected' : '' }}
                                                        value="{{ $unit->UnitName }}">{{ $unit->UnitName }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="Rate[]" class="form-control"
                                                value="{{ $detail->Rate }}">
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <div class="m-2">
                        <button type="button" class="btn btn-sm btn-success mt-2" onclick="addRow()">Add More</button>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('work-order.index') }}" type="button"
                            class="btn btn-cancel me-2 btn-dark">Cancel</a>
                        <button type="submit" id="submit-btn" class="btn btn-submit btn-primary">
                            Save
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            addRow();
        });
        $('#create-update-form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('quotation.store') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,

                success: function(response) {

                    $('#create-update-form')[0].reset(); // Reset all form data

                    notyf.success({
                        message: response.message,
                        duration: 3000
                    });

                    setTimeout(function() {
                        window.location.href = "{{ route('quotation.index') }}";
                    }, 1500); // Redirect after 1.5 seconds
                },
                error: function(e) {
                    const msg = e.responseJSON?.errors ?
                        Object.values(e.responseJSON.errors)[0][0] :
                        e.responseJSON?.message || 'An error occurred';

                    notyf.error({
                        message: msg,
                        duration: 5000
                    });
                }

            });
        });


        function addRow() {
            const table = $('#table tbody');
            const row = `
            <tr>
                <td></td>
                <td>
                    <select name="ItemID[]" class="form-control select2" style="width: 100%">
                        <option value="">Select</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->ItemID }}">{{ $item->ItemName }}</option>
                        @endforeach
                    </select>

                    <textarea name="Description[]" class="form-control mt-1"></textarea>
                </td>
                <td>
                    <select name="UnitName[]" class="form-select form-control-sm select2"
                        style="width: 100%">
                        <option value="">Select</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->UnitName }}">{{ $unit->UnitName }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="Rate[]" class="form-control">
                </td>
            </tr>`;

            table.append(row);
        }
    </script>
@endsection
