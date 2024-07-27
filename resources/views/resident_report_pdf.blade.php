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
        <span style="font-size: 16px; color:dodgerblue;"><strong>{{ $brgy_title }}</strong></span><br>
        <span style="font-size: 10px;"><strong>{{ $telephone_title }}</strong></span>
    </p>
    <hr style="width:100%;text-align:left;margin-left:0">
    <h2 style="text-align: center; font-size: 20px;"><strong>{{ $title }}</strong></h2>
    <table>
        <tr>
            <th style="text-transform: uppercase;">Barangay ID Number</th>
            <th style="text-transform: uppercase;">Resident</th>
            <th style="text-transform: uppercase;">Age</th>
            <th style="text-transform: uppercase;">Age Category</th>
            <th style="text-transform: uppercase;">Gender</th>
            <th style="text-transform: uppercase;">Civil Status</th>
            <th style="text-transform: uppercase;">Occupation</th>
            <th style="text-transform: uppercase;">Religion</th>
            <th style="text-transform: uppercase;">Educational Attainment</th>
            <th style="text-transform: uppercase;">Zone</th>
        </tr>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->barangay_id_number }}</td>
                <td>{{ $row->user_info->firstname . " " . $row->user_info->lastname }}</td>
                <td>{{ $row->age }}</td>
                <td>{{ $row->age_category }}</td>
                <td>{{ $row->gender == 1 ? 'Male' : ($row->gender == 2 ? 'Female' : 'Other') }}</td>
                <td>
                    @if ($row->civil_status == 1)
                        Single
                    @elseif ($row->civil_status == 2)
                        Married
                    @elseif ($row->civil_status == 3)
                        Widow/er
                    @elseif ($row->civil_status == 4)
                        Annulled
                    @elseif ($row->civil_status == 5)
                        Legally Separated
                    @else
                        Others
                    @endif
                </td>
                <td>{{ $row->occupation }}</td>
                <td>{{ $row->religion }}</td>
                <td>
                    @if($row->educational_attainment == 1)
                        Elementary Graduate
                    @elseif($row->educational_attainment == 2)
                        Elementary Undergraduate
                    @elseif($row->educational_attainment == 3)
                        High School Graduate
                    @elseif($row->educational_attainment == 4)
                        High School Undergraduate
                    @elseif($row->educational_attainment == 5)
                        College Graduate
                    @elseif($row->educational_attainment == 6)
                        College Undergraduate
                    @elseif($row->educational_attainment == 7)
                        Masters Graduate
                    @elseif($row->educational_attainment == 8)
                        Some/Completed Masters Degree
                    @elseif($row->educational_attainment == 9)
                        Vocational
                    @elseif($row->educational_attainment == 10)
                        Others
                    @endif
                </td>
                <td>{{ $row->zone }}</td>
            </tr>
        @endforeach
    </table>
    <!-- Footer -->
    <div class="footer">
        <p>Page {PAGE_NUM} of {PAGE_COUNT}</p>
        <p>Generated on {{ date('F j, Y') }}</p>
    </div>
</body>
</html>
