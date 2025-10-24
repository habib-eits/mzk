@extends('template.tmp')
@section('title', 'Invoice')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <form id="create-update-form">
                    @csrf
                    <input type="hidden" name="InvoiceMasterID" value="{{ $invoice->InvoiceMasterID }}">
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
                                                        {{ $invoice->PartyID == $party->PartyID ? 'selected' : '' }}>
                                                        {{ $party->PartyName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Attension</label>
                                        <div class="col-md-8">
                                            <input type="text" name="Attension" class="form-control"
                                                value="{{ $invoice->Attension }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Subject</label>
                                        <div class="col-md-8">
                                            <input type="text" name="Subject" class="form-control"
                                                value="{{ $invoice->Subject }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Project Name</label>
                                        <div class="col-md-8">
                                            <input type="text" name="ProjectName" class="form-control"
                                                placeholder="Project Name - location" value="{{ $invoice->ProjectName }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-4 col-form-label">Project Engg</label>
                                        <div class="col-md-8">
                                            <input type="text" name="ProjectEngg" class="form-control"
                                                value="{{ $invoice->ProjectEngg }}">
                                        </div>
                                    </div>



                                </div>


                                {{-- right side --}}
                                <div class="col-md-4">

                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Reference No</label>
                                        <div class="col-md-6">
                                            <input type="text" name="ReferenceNo" class="form-control"
                                                value="{{ old('ReferenceNo', $invoice->ReferenceNo) }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Invoice Date</label>
                                        <div class="col-md-6">
                                            <input type="date" name="Date" class="form-control"
                                                value="{{ $invoice->Date != null ? $invoice->Date : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Invoice Expiry</label>
                                        <div class="col-md-6">
                                            <input type="date" name="DueDate" class="form-control"
                                                value="{{ $invoice->DueDate != null ? $invoice->DueDate : date('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-6 col-form-label">Tender No</label>
                                        <div class="col-md-6">
                                            <input type="text" name="TenderNo" class="form-control"
                                                value="{{ $invoice->TenderNo }}">
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="row col-md-12">
                                <table id="table" class="">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%">Item</th>
                                            <th style="width: 25%">Work Description</th>
                                            <th style="width: 7%">Unit</th>
                                            <th style="width: 7%">Prev.</th>
                                            <th style="width: 7%">Current</th>
                                            <th style="width: 7%">Cumulative</th>
                                            <th style="width: 7%">Rate</th>
                                            <th style="width: 15%">Total</th>
                                            <th style="width: 5%"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($invoice->details as $detail)
                                            <tr>


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
                                                    <input type="number" name="Previous[]"
                                                        class="form-control  row-previous"
                                                        value="{{ $detail->Previous }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="Current[]"
                                                        class="form-control  row-current" value="{{ $detail->Current }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="Cumulative[]"
                                                        class="form-control  row-cumulative"
                                                        value="{{ $detail->Cumulative }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="Rate[]" class="form-control  row-rate"
                                                        value="{{ $detail->Rate }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="Total[]" class="form-control  row-total"
                                                        value="{{ $detail->Total }}">
                                                </td>
                                                <td class="text-center">
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


    @include('invoices.js')
@endsection
