<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pagetitle }}</title>

    <style>
        body, td, th {
            font-size: 13px;
            font-family: Arial, sans-serif;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #ccc;
        }
        td, th {
            padding: 3px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <table border="0">
        <tr>
            <td colspan="2" class="title" align="center">
                {{ session('CompanyName') }}
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                {{ $party->PartyName }} - {{ $party->PartyID }}
            </td>
        </tr>

       
        <tr>
            <td colspan="2" align="center">
                TRN: {{ $party->TRN }}
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                From {{ session('StartDate') }} to {{ session('EndDate') }}
            </td>
        </tr>

        <tr>
            <td width="50%">Dated: {{ date('d-m-Y') }}</td>
            <td width="50%"></td>
        </tr>
    </table>

    @php
        $DrTotal = 0;
        $CrTotal = 0;
        $openingBalance = $sql['Balance'] ?? 0;
        $balance = $openingBalance;
    @endphp

    @if($journal->count() > 0)

    <table border="1">
        <thead>
            <tr>
                <th class="text-center">DATE</th>
                <th class="text-center">Bill No / VHNO</th>
                <th class="text-center">DESCRIPTION</th>
                <th class="text-center">Bill Amount</th>
                <th class="text-center">Paid</th>
                <th class="text-center">BALANCE</th>
            </tr>
        </thead>

        <tbody>

            <!-- Opening Balance -->
            @if($openingBalance >0)
            <tr>
                <td></td>
                <td></td>
                <td class="text-center"><strong>Opening Balance</strong></td>
                <td></td>
                <td></td>
                <td class="text-right">{{ number_format($openingBalance, 2) }}</td>
            </tr>
            @endif
            <!-- Ledger Entries -->
            @foreach ($journal as $row)
                @php
                    $DrTotal += $row->Dr;
                    $CrTotal += $row->Cr;
                    $balance += ($row->Dr - $row->Cr);
                @endphp

                <tr>
                    <td class="text-center">{{ dateformatman($row->Date) }}</td>
                    <td class="text-center">{{ $row->VHNO }}</td>
                    <td>{{ $row->Narration }}</td>

                    <td class="text-right">
                        {{ $row->Dr == 0 ? '' : number_format($row->Dr, 2) }}
                    </td>

                    <td class="text-right">
                        {{ $row->Cr == 0 ? '' : number_format($row->Cr, 2) }}
                    </td>

                    <td class="text-right">
                        {{ number_format($balance, 2) }} 
                        {{ $balance > 0 ? 'DR' : 'CR' }}
                    </td>
                </tr>
            @endforeach

            <!-- Totals -->
            <tr>
                <td></td>
                <td><strong>TOTAL</strong></td>
                <td></td>

                <td class="text-right"><strong>{{ number_format($DrTotal, 2) }}</strong></td>
                <td class="text-right"><strong>{{ number_format($CrTotal, 2) }}</strong></td>
                <td class="text-right"></td>
            </tr>

        </tbody>
    </table>

    @else
        <p class="text-danger">No data found</p>
    @endif

</body>
</html>
