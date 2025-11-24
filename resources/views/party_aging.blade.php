{{-- resources/views/party_aging.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Aging Report - {{ $today }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #000;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; font-size: 12px; color: #555; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px 10px;
            text-align: right;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            font-size: 10px;
        }
        .party-name {
            text-align: left !important;
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .total-row {
            font-weight: bold;
            background-color: #e0e0e0 !important;
        }
        .grand-total {
            background-color: #333 !important;
            color: white;
            font-size: 12px;
        }
        .text-left { text-align: left !important; }
        .text-center { text-align: center !important; }
        .no-data { text-align: center; padding: 30px; color: #888; }
        @page { margin: 1cm; }
    </style>
</head>
<body>

<div class="header">
    <h1>PARTY AGING REPORT (RECEIVABLES)</h1>
    <p>As on: <strong>{{ \Carbon\Carbon::parse($today)->format('d-M-Y') }}</strong></p>
    <p>Generated on: {{ now()->format('d-M-Y h:i A') }}</p>
</div>

@if(count($allAging) == 0)
    <div class="no-data">No outstanding balances found.</div>
@else
    <table>
        <thead>
            <tr>
                <th width="20%" class="text-left">Party Name</th>
                <th width="12%">0-30 Days</th>
                <th width="12%">31-60 Days</th>
                <th width="12%">61-90 Days</th>
                <th width="12%">91-120 Days</th>
                <th width="12%">121+ Days</th>
                <th width="15%" style="background:#ffcccc;">Total Outstanding</th>
            </tr>
        </thead>
        <tbody>

            @php
                $grandTotal = 0;
                $totals = ['0-30' => 0, '31-60' => 0, '61-90' => 0, '91-120' => 0, '121+' => 0];
            @endphp

            @foreach($allAging as $item)
                @php
                    $aging = $item['aging'];
                    $grandTotal += $item['total'];

                    foreach($totals as $key => $val) {
                        $totals[$key] += $aging[$key];
                    }
                @endphp

                <tr>
                    <td class="party-name">
                        {{ $item['party']->PartyName ?? 'Unknown' }}
                        @if(!empty($item['party']->City))
                            <br><small style="color:#666;">{{ $item['party']->City }}</small>
                        @endif
                    </td>
                    <td>{{ number_format($aging['0-30'], 2) }}</td>
                    <td>{{ number_format($aging['31-60'], 2) }}</td>
                    <td>{{ number_format($aging['61-90'], 2) }}</td>
                    <td>{{ number_format($aging['91-120'], 2) }}</td>
                    <td style="background:#fff2f2; font-weight:bold;">
                        {{ number_format($aging['121+'], 2) }}
                    </td>
                    <td style="background:#ffcccc; font-weight:bold; color:#d00;">
                        {{ number_format($item['total'], 2) }}
                    </td>
                </tr>
            @endforeach

            {{-- Grand Total Row --}}
            <tr class="grand-total">
                <td class="text-left"><strong>GRAND TOTAL</strong></td>
                <td><strong>{{ number_format($totals['0-30'], 2) }}</strong></td>
                <td><strong>{{ number_format($totals['31-60'], 2) }}</strong></td>
                <td><strong>{{ number_format($totals['61-90'], 2) }}</strong></td>
                <td><strong>{{ number_format($totals['91-120'], 2) }}</strong></td>
                <td><strong>{{ number_format($totals['121+'], 2) }}</strong></td>
                <td><strong>{{ number_format($grandTotal, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
@endif

<br><br>


</body>
</html>