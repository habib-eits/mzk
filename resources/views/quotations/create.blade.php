@extends('template.tmp')
@section('title', 'Quotation')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <form id="create-update-form">
                    @csrf
                    <input type="hidden" name="InvoiceMasterID" value="{{ $quotation->InvoiceMasterID }}">
                    <div class="card">
                        <div class="card-body">
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
                                                placeholder="Project Name - location" value="{{ $quotation->ProjectName }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Project Engg</label>
                                        <div class="col-md-8">
                                            <input type="text" name="ProjectEngg" class="form-control"
                                                value="{{ $quotation->ProjectEngg }}">
                                        </div>
                                    </div>



                                </div>


                                {{-- right side --}}
                                <div class="col-md-4">

                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Reference No</label>
                                        <div class="col-md-6">
                                            <input type="text" name="ReferenceNo" class="form-control"
                                                value="{{ old('ReferenceNo', $quotation->ReferenceNo) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Quotation Date</label>
                                        <div class="col-md-6">
                                            <input type="date" name="Date" class="form-control"
                                                value="{{ $quotation->Date != null ? $quotation->Date : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Quotation Expiry</label>
                                        <div class="col-md-6">
                                            <input type="date" name="DueDate" class="form-control"
                                                value="{{ $quotation->DueDate != null ? $quotation->DueDate : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Tender No</label>
                                        <div class="col-md-6">
                                            <input type="text" name="TenderNo" class="form-control"
                                                value="{{ $quotation->TenderNo }}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row col-md-12">
                                <table id="table" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%">Service</th>
                                            <th style="width: 20%">Item</th>
                                            <th style="width: 30%">Work Description</th>
                                            <th style="width: 15%">Unit</th>
                                            <th style="width: 15%">Rate</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($quotation->details as $detail)
                                            <tr>

                                                <td>
                                                    <select name="service_type_id[]" class="form-control select2"
                                                        style="width: 100%">
                                                        <option value="">Select</option>
                                                        @foreach ($serviceTypes as $service)
                                                            <option
                                                                {{ $service->id == $detail->service_type_id ? 'selected' : '' }}
                                                                value="{{ $service->id }}">{{ $service->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="ItemID[]" class="form-control select2 row-item-select"
                                                        style="width: 100%">
                                                        <option value="">Select</option>
                                                        @foreach ($items as $item)
                                                            <option
                                                                {{ $item->ItemID == $detail->ItemID ? 'selected' : '' }}
                                                                data-UnitName="{{ $item->UnitName }}"
                                                                data-SellingPrice="{{ $item->SellingPrice }}"
                                                                value="{{ $item->ItemID }}">{{ $item->ItemName }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <textarea name="Description[]" rows="1" class="form-control">{{ $detail->Description }}</textarea>
                                                </td>

                                                <td>
                                                    <select name="UnitName[]"
                                                        class="form-select form-control-sm select2 row-unit-select"
                                                        style="width: 100%">
                                                        <option value="">Select</option>
                                                        @foreach ($units as $unit)
                                                            <option
                                                                {{ $unit->UnitName == $detail->UnitName ? 'selected' : '' }}
                                                                value="{{ $unit->UnitName }}">{{ $unit->UnitName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="Rate[]" class="form-control  row-rate"
                                                        value="{{ $detail->Rate }}">
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="removeRow(this, event)">
                                                        <span class="bx bx-trash"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <div class="m-2">
                                <button type="button" class="btn btn-sm btn-success mt-2" onclick="addRow()">Add
                                    More</button>
                            </div>
                        </div>

                    </div>





                    <div class="d-flex ">

                        <div class="col-6">
                            <h4>Section 1 <span id="default_scope_of_work_btn" class="btn btn-sm btn-primary">Default
                                    Content</span></h4>
                            <textarea class="form-control tinymce" id="scope_of_work" name="scope_of_work" placeholder="">{!! $scopeOfWork !!} </textarea>
                        </div>
                        <div class="col-6">
                            <h4>Section 2 <span id="default_terms_and_conditions_btn"
                                    class="btn btn-sm btn-primary">Default Content</span></h4>
                            <textarea class="form-control tinymce" id="terms_and_conditions" name="terms_and_conditions" placeholder="">{!! $termsAndConditions !!} </textarea>
                        </div>
                    </div>
                    <br>

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


    @include('quotations.js')
@endsection
