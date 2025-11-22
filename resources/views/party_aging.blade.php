<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Party Aging Summary</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .date {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            border: 1px solid #666;
            padding: 5px 6px;
            text-align: right;
        }

        th {
            background: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .left {
            text-align: left;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="title">Party Aging Summary</div>
<div class="date">As of {{ $today }}</div>

<table>
    <thead>
        <tr>
            <th class="left">Party Name</th>
            <th>0-30</th>
            <th>31-60</th>
            <th>61-90</th>
            <th>91-120</th>
            <th>121+</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach($allAging as $row)
        <tr>
            <td class="left">{{ $row['party']->PartyName }}</td>
            <td>{{ number_format($row['aging']['0-30'], 2) }}</td>
            <td>{{ number_format($row['aging']['31-60'], 2) }}</td>
            <td>{{ number_format($row['aging']['61-90'], 2) }}</td>
            <td>{{ number_format($row['aging']['91-120'], 2) }}</td>
            <td>{{ number_format($row['aging']['121+'], 2) }}</td>
            <td><strong>{{ number_format($row['total'], 2) }}</strong></td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
