<!DOCTYPE html>
<html>
<head>
    <title>Barangay Certificate</title>
    <style>

        body {
            font-family: "Century Gothic", sans-serif;
        }
        .center-text {
            text-align: center;
        }
        .left-text {
            text-align: left;
            margin-left: 48px;
        }
        .right-text {
            text-align: right;
            margin-right: 48px;
        }
        .justified-text {
            text-align: justify;
            margin-left: 48px;
            margin-right: 48px;
            line-height: 1.0;
            font-size: 1em;
        }
        .info-table {
            width: 100%;
            margin-left: 48px;
            margin-right: 48px;
            line-height: 1;
        }
        .info-table td {
            padding: 2px 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 7px;
        }
        hr.headerline1{
            margin-top: -15px;
            margin-bottom: 1px;
        }
        hr.headerline2{
            margin-top: 1px;
            margin-bottom: 1px;
        }
        .logo {
            height: 80px;
            width: auto;
        }
        .image-box1 {
            width: 2.8cm;
            height: 2.81cm;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
        }
        .image-box2 {
            width: 2.38cm;
            height: 2.42cm;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
            margin-left: 7px;
        }
        .image-box3 {
            width: 2.38cm;
            height: 2.42cm;
            border: 1px solid black;
            display: inline-block;
            text-align: center;
            margin-left: 7px;
        }
        .signature-box {
            height: 2.81cm;
            border: none;
            display: inline-block;
            width: 30%;
            margin-left: 105px;
        }
        .table-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-left: 48px;
            margin-right: 48px;
        }
        hr.signature-line {
            margin-top: 5px;
            margin-bottom: 5px;
        }
        p.signature-text {
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.png" class="logo" alt="Top Left Logo" style="float: left;">
        <img src="path_to_top_right_logo.png" class="logo" alt="Top Right Logo" style="float: right;">
        <p style="font-size: 17px;">Republic of the Philippines<br>Province of Oriental Mindoro<br>Municipality of Bansud<br><strong style="color: #008000;">BARANGAY PAG-ASA</strong></p>
        <hr class="headerline1" style="width: 100%; border: none; border-bottom: 1px solid #964B00;">
        <hr class="headerline2" style="width: 100%; border: none; border-bottom: 3px solid #964B00;">
        <p style="font-size: 27px;"><strong>OFFICE OF THE BARANGAY CAPTAIN</strong></p>
        <p style="font-size: 24px;"><strong>BARANGAY CLEARANCE</strong></p>
    </div>
    @php
        $link = '';
        if(isset($data[0]->resident_info->photo)){
            $link = public_path('storage/resident_photo/'.$data[0]->resident_info->photo);
        }

        function ordinal($number) {
            $suffixes = ['th','st','nd','rd','th','th','th','th','th','th'];
            if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
                return $number . 'th';
            } else {
                return $number . $suffixes[$number % 10];
            }
        }

        $day = date('j');
        $day_with_suffix = ordinal($day);
        $month = date('F');
        $year = date('Y');
    @endphp

    <p class="left-text"  style="font-size: 16px;"><b>TO WHOM IT MAY CONCERN:</b></p>

    <p class="justified-text" style="text-indent: 50px;">This is to certify that the person whose name, picture, and signature appear herein has requested a <strong>CLEARANCE</strong> from this office.</p>

    <table class="info-table">
        <tr>
            <td><strong>NAME</strong></td>
            <td>:</td>
            <td><u style="text-transform: capitalize;">{{ $data[0]->resident_info->user_info->lastname}}, {{$data[0]->resident_info->user_info->firstname}} {{$data[0]->resident_info->user_info->middle_initial }}</u></td>
        </tr>
        <tr>
            <td><strong>ADDRESS</strong></td>
            <td>:</td>
            <td><u style="text-transform: capitalize;">{{ $data[0]->resident_info->zone .' '. $data[0]->resident_info->street .' '. $data[0]->resident_info->block }}</u></td>
        </tr>
        <tr>
            <td><strong>CIVIL STATUS</strong></td>
            <td>:</td>
            <td><u>{{ $data[0]->resident_info->civil_status }}</u></td>
        </tr>
        <tr>
            <td><strong>GENDER</strong></td>
            <td>:</td>
            <td><u>{{ $data[0]->resident_info->gender }}</u></td>
        </tr>
        <tr>
            <td><strong>DATE OF BIRTH</strong></td>
            <td>:</td>
            <td><u>{{ $data[0]->resident_info->birthdate }}</u></td>
        </tr>
        <tr>
            <td><strong>PLACE OF BIRTH</strong></td>
            <td>:</td>
            <td><u style="text-transform: capitalize;">{{ $data[0]->resident_info->birth_place }}</u></td>
        </tr>
        <tr>
            <td><strong>PURPOSE</strong></td>
            <td>:</td>
            <td><u>{{ $data[0]->purpose }}</u></td>
        </tr>
    </table>
    
    <br><br>

    <div class="table-row">
        <div class="image-box1"></div>
        <div class="image-box2"></div>
        <div class="image-box3"></div>
        <div class="signature-box">
            <hr class="signature-line" style="margin-top: 60px; height: -10px;">
            <p class="center-text signature-text"><strong>SIGNATURE</strong></p>
        </div>
    </div>

    <p class="justified-text" style="text-indent: 50px;">This certifies further that <strong>the above-named person</strong>, as far as records in this office are concerned, has never been accused or convicted of any civil, criminal, or administrative case.</p>

    <p class="justified-text" style="margin-top: -15px; text-indent: 50px;"><strong>IN WITNESS WHEREOF</strong>, I have hereunto set my hand this <u>{{ $day_with_suffix }}</u> day of <u>{{ $month }}</u> {{ $year }} at Barangay Pag-asa, Bansud Oriental Mindoro.</p>
    <br>
    <p class="right-text" style="font-size: 15px;"><strong>ARHUNFOL D. RODA</strong><br>Barangay Captain</p>

    <p class="left-text" style="font-size: 15px;"><strong>Fee:</strong> <u>{{ $amount_collection }}</u></p>
    <p class="left-text" style="font-size: 15px;"><strong>O.R No.:</strong> <u>{{ $or_number }}</u></p>
    <p class="left-text" style="font-size: 15px;"><strong>CTC:</strong> <u style="color:rgb(17, 16, 16);">______</u></p>
    <br>
    <br>
    <p class="center-text" style="font-size: 16px;"><i>Not valid without seal.</i></p>
</body>
</html>
