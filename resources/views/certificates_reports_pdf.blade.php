<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Reports</title>
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
        .header .logo-left {
            margin-top: 7px;
            position: absolute;
            margin-left: 55px;
            top: 0;
            left: 0;
            height: 80px; /* Adjusted height */
            width: 80px; /* Adjusted width */
        }
        .header .logo-right {
            position: absolute;
            margin-right: 55px;
            top: 0;
            right: 0;
            height: 80px; /* Adjusted height */
            width: 80px; /* Adjusted width */
            margin-top: 7px;
        }
        .logo {
            height: 80px;
            width: auto;
        }
        .watermark {
            position: absolute;
            top: 60%;
            left: 50%;
            width: 80%;
            height: 80%;
            opacity: 0.2; /* Adjust opacity as needed */
            pointer-events: none; /* Ensure it doesn't interfere with content interaction */
            z-index: -1; /* Place it behind the text */
            transform: translate(-50%, -50%) rotate(-0deg); /* Center and rotate the watermark */
        }
        hr.headerline1{
            margin-top: -10px;
            margin-bottom: 1px;
        }
        hr.headerline2{
            margin-top: 1px;
            margin-bottom: 1px;
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <img src="file://{{ $logoright }}" class="watermark" alt="Watermark Logo">

    <div class="header">
        <img src="file://{{ $logoleft }}" class="logo-left" alt="Top Left Logo" style="float: left;">
        <img src="file://{{ $logoright }}" class="logo-right" alt="Top Right Logo" style="float: right;">
        <h1 style="text-align: center; font-size: 18px;"><strong>{{ $repub_title }}</strong></h1>
        <p style="text-align: center; font-size: 12px;">
        {{ $province_title }}<br>
        <span>{{ $city_title }}</span><br>
        <span style="font-size: 16px; color:#008000;"><strong>{{ $brgy_title }}</strong></span><br>
        <hr class="headerline1" style="width: 100%; border: none; border-bottom: 1px solid #964B00;">
        <hr class="headerline2" style="width: 100%; border: none; border-bottom: 3px solid #964B00;">
    </p>
    </div>
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
