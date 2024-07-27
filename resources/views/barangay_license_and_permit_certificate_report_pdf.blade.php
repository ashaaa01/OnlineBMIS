<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barangay License and Permit Certificate</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<body>
    <h1 style="text-align: center; font-size: 20px;" ><strong>{{ $repub_title }}</strong></h1>
    <p style="text-align: center; font-size: 15px;">{{ $province_title }}<br>
        <span>{{ $city_title }}</span><br>
        <span style="font-size: 18px; color:dodgerblue;"><strong>{{ $brgy_title }}</strong></span><br>
        <span style="font-size: 12px;"><strong>{{ $telephone_title }}</strong></span>
    </p>

    <hr style="width:100%;text-align:left;margin-left:0">
    <h2 style="text-align: center;"><strong>LIST OF LICENSE & PERMIT CERTIFICATES</strong><br>
    <table style="width:100%">
        <tr>
            <th style="text-transform: uppercase; white-space: normal; width: 100px; border: 1px solid black;">OR Number</th>
            <th style="text-transform: uppercase; white-space: normal; width: 120px; border: 1px solid black;">Requested By</th>
            <th style="text-transform: uppercase; white-space: normal; width: 100px; border: 1px solid black;">Purpose</th>
            <th style="text-transform: uppercase; white-space: normal; width: 120px; border: 1px solid black;">Business Name</th>
            <th style="text-transform: uppercase; white-space: normal; width: 100px; border: 1px solid black;">Location</th>
            <th style="text-transform: uppercase; white-space: normal; width: 120px; border: 1px solid black;">Nature of business</th>
        </tr>

        @foreach ($data as $row)
            <tr>
                <td style="white-space: normal; border: 1px solid black;">{{ $row->or_number }}</td>
                <td style="white-space: normal; border: 1px solid black; text-transform:capitalize;">{{ $row->resident_info->user_info->firstname ." ". $row->resident_info->user_info->lastname }}</td>
                <td style="white-space: normal; border: 1px solid black;">{{ $row->purpose }}</td>
                <td style="white-space: normal; border: 1px solid black;">{{ $row->business_name }}</td>
                <td style="white-space: normal; border: 1px solid black;">{{ $row->location }}</td>
                <td style="white-space: normal; border: 1px solid black;">{{ $row->nature_of_business }}</td>
            </tr>
        @endforeach
        {{-- <tr>
            <td>{{ $data[0]->or_number }}</td>
            <td>{{ $data[0]->resident_info->user_info->firstname ." ". $data[0]->resident_info->user_info->lastname }}</td>
            <td>{{ $data[0]->purpose }}</td>
            <td>{{ $data[0]->business_name }}</td>
            <td>{{ $data[0]->location }}</td>
            <td>{{ $data[0]->nature_of_business }}</td>
        </tr> --}}
    </table>




</body>
</html>
