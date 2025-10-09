<!DOCTYPE html>
<html>
<head>
    <title>Profit & Loss Statement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
        body {
            padding: 2rem;
            font-size: 14px;
        }
        .section-title {
            margin-top: 2rem;
            font-weight: bold;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 0.5rem;
        }
        .table thead th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Profit & Loss Statement</h2>
        <p class="text-muted">As of {{ \Carbon\Carbon::now()->format('F d, Y') }}</p>
    </div>

        @foreach($revenue as $row)
            <div class="section-title">{{ $row['parent_name'] }}</div>

            <table class="table table-bordered table-sm mt-2">
                <thead>
                    <tr>
                        <th style="width: 75px;">#</th>
                        <th style="width: 350px;">Account Name</th>
                        <th class="text-end">Debit (Dr)</th>
                        <th class="text-end">Credit (Cr)</th>
                        <th class="text-end">Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; $totalDr = 0; $totalCr = 0; @endphp
                    @foreach($row['children'] as $child)
                    
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $child['AccountName'] }}</td>
                            <td class="text-end">{{ number_format($child['Dr'], 2) }}</td>
                            <td class="text-end">{{ number_format($child['Cr'], 2) }}</td>
                            <td class="text-end">{{ number_format($child['Bal'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="fw-bold">
                        <td colspan="2" class="text-end">Total</td>
                        <td class="text-end">{{ number_format($totalDr, 2) }}</td>
                        <td class="text-end">{{ number_format($totalCr, 2) }}</td>
                        <td class="text-end">{{ number_format($totalDr - $totalCr, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        @endforeach













    
    @foreach($expense as $row)
        <div class="section-title">{{ $row['parent_name'] }} - {{ $row['parent_total'] }}</div>

        <table class="table table-bordered table-sm mt-2">
            <thead>
                <tr>
                    <th style="width: 75px;">#</th>
                    <th style="width: 350px;">Account Name</th>
                    <th class="text-end">Debit (Dr)</th>
                    <th class="text-end">Credit (Cr)</th>
                    <th class="text-end">Balance</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1; $totalDr = 0; $totalCr = 0; @endphp
                @foreach($row['children'] as $child)
                   
                    <tr>
                        <td>{{ $index++ }}</td>
                        <td>{{ $child['AccountName'] }}</td>
                        <td class="text-end">{{ number_format($child['Dr'], 2) }}</td>
                        <td class="text-end">{{ number_format($child['Cr'], 2) }}</td>
                        <td class="text-end">{{ number_format($child['Bal'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="fw-bold">
                    <td colspan="2" class="text-end">Total</td>
                    <td class="text-end">{{ number_format($totalDr, 2) }}</td>
                    <td class="text-end">{{ number_format($totalCr, 2) }}</td>
                    <td class="text-end">{{ number_format($totalDr - $totalCr, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    @endforeach

    <div class="text-center mt-5 no-print">
        <button onclick="window.print()" class="btn btn-primary">Print Report</button>
    </div>

</body>
</html>
