@extends('template.tmp')

@section('title', $pagetitle)

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-print-block d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Party SOA</h4>

                        <div class="text-end">
                            <strong>{{ $party->PartyID }} - {{ $party->PartyName }}</strong><br>
                            <strong>TRN{{ $party->TRN }}</strong><br>
                            From: <strong>{{ request()->StartDate }}</strong>  
                            To: <strong>{{ request()->EndDate }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error Messages -->
            @if (session('error'))
                <div class="alert alert-{{ session('class') }} p-1">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger p-2 border-3">
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $DrTotal = 0;
                $CrTotal = 0;
                $balance = $openingBalance = $sql['Balance'] ?? 0;
            @endphp

            <div class="card">
                <div class="card-body">

                    @if ($journal->count() > 0)
                        <table class="table table-sm table-bordered table-striped align-middle table-nowrap mb-0">
                            
                            <!-- Table Header -->
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center col-md-1">DATE</th>
                                    <th class="text-center col-md-1">Bill No / VHNO</th>
                                    <th class="text-center col-md-5">Description</th>
                                    <th class="text-center col-md-1">Bill Amount</th>
                                    <th class="text-center col-md-1">Paid</th>
                                    <th class="text-center col-md-1">Balance</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Opening Balance Row -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Opening Balance</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end text-danger">{{ number_format($openingBalance, 2) }}</td>
                                </tr>

                                <!-- Ledger Entries -->
                                @foreach ($journal as $entry)
                                    @php
                                        $DrTotal += $entry->Dr;
                                        $CrTotal += $entry->Cr;
                                        $balance += ($entry->Dr - $entry->Cr);
                                    @endphp

                                    <tr>
                                        <td class="text-center">{{ dateformatman($entry->Date) }}</td>
                                        <td class="text-center">{{ $entry->VHNO }}</td>
                                        <td>{{ $entry->Narration }}</td>

                                        <td class="text-end">
                                            {{ $entry->Dr == 0 ? '' : number_format($entry->Dr, 2) }}
                                        </td>

                                        <td class="text-end">
                                            {{ $entry->Cr == 0 ? '' : number_format($entry->Cr, 2) }}
                                        </td>

                                        <td class="text-end">
                                            {{ number_format($balance, 2) }}
                                            <strong>{{ $balance > 0 ? 'DR' : 'CR' }}</strong>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Totals -->
                                <tr class="table-active">
                                    <td></td>
                                    <td><strong>TOTAL</strong></td>
                                    <td></td>
                                    <td class="text-end fw-bolder">{{ number_format($DrTotal, 2) }}</td>
                                    <td class="text-end fw-bolder">{{ number_format($CrTotal, 2) }}</td>
                                    <td class="text-end fw-bolder">{{ number_format($balance, 2) }}</td>
                                </tr>
                            </tbody>

                        </table>

                    @else
                        <p class="text-danger">No data found</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@endsection

