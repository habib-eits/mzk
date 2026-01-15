@extends('template.tmp')

@section('title', $pagetitle)

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profit & Loss</h4>
                        <strong>
                            From {{ request()->StartDate }} TO {{ request()->EndDate }}
                        </strong>
                    </div>
                </div>
            </div>

            {{-- Errors --}}
            @if (session('error'))
                <div class="alert alert-{{ session('class') }} p-1">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger p-1 border-3">
                    <strong>There were some problems with your input.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $TotalRevenue = 0;
                $TotalExpense = 0;
            @endphp

            <div class="card">
                <div class="card-body">

                    {{-- ================= REVENUE ================= --}}
                    <table class="table table-bordered table-sm">
                        <thead class="bg-light">
                            <tr>
                                <td width="20%"></td>
                                <td width="60%"><strong>REVENUES</strong></td>
                                <td width="20%"></td>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($chartofaccountr as $parent)
                            @php
                                $SubTotal = 0;

                                $accounts = DB::table('chartofaccount')
                                    ->where('CODE', 'R')
                                    ->where('L2', $parent->ChartOfAccountID)
                                    ->where('Level',3)
                                    ->get();
                            @endphp

                            <tr>
                                <td>{{ $parent->ChartOfAccountID }}</td>
                                <td><strong>{{ $parent->ChartOfAccountName }}</strong></td>
                                <td></td>
                            </tr>

                            @foreach ($accounts as $acc)
                                @php
                                    $balance = DB::table('v_journal')
                                        ->whereBetween('Date', [request()->StartDate, request()->EndDate])
                                        ->where('ChartOfAccountID', $acc->ChartOfAccountID)
                                        ->selectRaw('COALESCE(SUM(Cr),0) - COALESCE(SUM(Dr),0) as Balance')
                                        ->value('Balance');

                                    $SubTotal += $balance;
                                    $TotalRevenue += $balance;
                                @endphp
                                @if($balance != 0)
                                <tr>
                                    <td>{{ $acc->ChartOfAccountID }}</td>
                                    <td style="padding-left:20px">{{ $acc->ChartOfAccountName }}</td>
                                    <td>
                                        <a target="_blank"
                                           href="{{ url('BalanceSheetDetail/'.$acc->ChartOfAccountID.'/'.request()->StartDate.'/'.request()->EndDate) }}">
                                            {{ number_format($balance, 2) }}
                                        </a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                            <tr class="bg-light">
                                <td></td>
                                <td><strong>{{ $parent->ChartOfAccountName }}</strong></td>
                                <td><strong>{{ number_format($SubTotal, 2) }}</strong></td>
                            </tr>
                        @endforeach

                         <tr class="bg-success">
                            <td></td>
                            <td><strong>TOTAL Revenue</strong></td>
                            <td><strong>{{ number_format($TotalRevenue, 2) }}</strong></td>
                        </tr>

                        </tbody>
                    </table>

                    {{-- ================= EXPENSES ================= --}}
                    <table class="table table-bordered table-sm mt-4">
                        <thead class="bg-light">
                            <tr>
                                <td width="20%"></td>
                                <td width="60%"><strong>EXPENSES</strong></td>
                                <td width="20%"></td>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($chartofaccounte as $parent)
                            @php
                                $SubTotal = 0;

                                $accounts = DB::table('chartofaccount')
                                    ->where('CODE', 'E')
                                    ->where('L2', $parent->ChartOfAccountID)
                                    ->where('Level',3)
                                    ->get();
                            @endphp

                            <tr>
                                <td>{{ $parent->ChartOfAccountID }}</td>
                                <td><strong>{{ $parent->ChartOfAccountName }}</strong></td>
                                <td></td>
                            </tr>

                            @foreach ($accounts as $acc)
                                @php
                                    $balance = DB::table('v_journal')
                                        ->whereBetween('Date', [request()->StartDate, request()->EndDate])
                                        ->where('ChartOfAccountID', $acc->ChartOfAccountID)
                                        ->selectRaw('COALESCE(SUM(Dr),0) - COALESCE(SUM(Cr),0) as Balance')
                                        ->value('Balance');

                                    $SubTotal += $balance;
                                    $TotalExpense += $balance;
                                @endphp
                                @if($balance != 0)    
                                <tr>
                                    <td>{{ $acc->ChartOfAccountID }}</td>
                                    <td style="padding-left:20px">{{ $acc->ChartOfAccountName }}</td>
                                    <td>{{ number_format($balance, 2) }}</td>
                                </tr>
                                @endif
                            @endforeach

                            <tr class="bg-light">
                                <td></td>
                                <td><strong>Total {{ $parent->ChartOfAccountName }}</strong></td>
                                <td><strong>{{ number_format($SubTotal, 2) }}</strong></td>
                            </tr>
                        @endforeach

                        <tr class="bg-warning">
                            <td></td>
                            <td><strong>TOTAL EXPENSES</strong></td>
                            <td><strong>{{ number_format($TotalExpense, 2) }}</strong></td>
                        </tr>

                        <tr class="bg-success text-white">
                            <td></td>
                            <td><strong>PROFIT / LOSS</strong></td>
                            <td>
                                <strong>{{ number_format($TotalRevenue - $TotalExpense, 2) }}</strong>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
