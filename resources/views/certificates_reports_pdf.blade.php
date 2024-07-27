<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resident Certificate</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 0 auto;
            font-size: 12px;
        }
        th, td {
            padding: 4px;
        }
        th {
            background-color: #f2f2f2;
            font-size: 15px;
        }
        @page {
            margin: 10mm;
        }
        .page-break {
            page-break-before: always;
        }
        .footer {
            position: fixed;
            bottom: 10mm;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; font-size: 18px;"><strong>{{ $repub_title }}</strong></h1>
    <p style="text-align: center; font-size: 12px;">
        {{ $province_title }}<br>
        <span>{{ $city_title }}</span><br>
        <span style="font-size: 16px; color: dodgerblue;"><strong>{{ $brgy_title }}</strong></span><br>
        <span style="font-size: 10px;"><strong>{{ $telephone_title }}</strong></span>
    </p>
    <hr style="width:100%;text-align:left;margin-left:0">
    <h2 style="text-align: center; font-size: 20px;"><strong>{{ $title }}</strong></h2>
    <table>
        <thead>
            <tr>
                <th style="text-transform: uppercase;">Document Type</th>
                <th style="text-transform: uppercase;">Requested By</th>
                <th style="text-transform: uppercase;">OR Number</th>
                <th style="text-transform: uppercase;">Purpose</th>
                <th style="text-transform: uppercase;">Amount Collected</th>
                <th style="text-transform: uppercase;">Requested Date</th>
                <th style="text-transform: uppercase;">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row['document_type'] }}</td>
                <td>{{ $row['requested_by'] }}</td>
                <td>{{ $row['or_number'] }}</td>
                <td>{{ $row['purpose'] }}</td>
                <td>{{ $row['amount_collection'] }}</td>
                <td>{{ $row['requested_date'] }}</td>
                <td>{{ $row['remarks'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Footer -->
    <div class="footer">
        <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        <p>Generated on {{ date('F j, Y') }}</p>
    </div>
</body>
</html>
