@php
    use Carbon\Carbon;
@endphp
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
            line-height: 2;
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
            margin-top: 0%;
        }
        hr.headerline1{
            margin-top: -15px;
            margin-bottom: 1px;
        }
        hr.headerline2{
            margin-top: 1px;
            margin-bottom: 1px;
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
        .watermark {
            position: absolute;
            top: 52%;
            left: 50%;
            width: 100%;
            height: 60%;
            opacity: 0.2; /* Adjust opacity as needed */
            pointer-events: none; /* Ensure it doesn't interfere with content interaction */
            z-index: -1; /* Place it behind the text */
            transform: translate(-50%, -50%) rotate(-0deg); /* Center and rotate the watermark */
        }
    </style>
</head>
<body>
    <!-- Watermark -->
    <img src="file://{{ $logoright }}" class="watermark" alt="Watermark Logo">

    <div class="header" >
        <img src="file://{{ $logoleft }}" class="logo-left" alt="Top Left Logo" style="float: left;">
        <img src="file://{{ $logoright }}" class="logo-right" alt="Top Right Logo" style="float: right;">
        <p style="font-size: 17px;">Republic of the Philippines<br>Province of Oriental Mindoro<br>Municipality of Bansud<br><strong style="color: #008000;">BARANGAY PAG-ASA</strong></p>
        <hr class="headerline1" style="width: 100%; border: none; border-bottom: 1px solid #964B00;">
        <hr class="headerline2" style="width: 100%; border: none; border-bottom: 3px solid #964B00;">
        <p style="font-size: 27px;"><strong>OFFICE OF THE BARANGAY CAPTAIN</strong></p>
        <p style="font-size: 24px;"><strong style="color: #008000;"><u>BARANGAY PERMIT</u></strong></p>
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

        $formattedPeriodDateOf = Carbon::parse($period_date_of)->format('F d, Y');
        $formattedPeriodDateTo = Carbon::parse($period_date_to)->format('F d, Y');

        // Ensure data exists before accessing
        $issued_on = $data[0]->issued_on ?? null;

        // Parse and format the date
        if ($issued_on) {
            $parsedIssuedOn = Carbon::parse($issued_on);
            $day = $parsedIssuedOn->format('j'); // Day of the month (e.g., 1, 2, ..., 31)
            $month = $parsedIssuedOn->format('F'); // Full month name (e.g., January, February, ...)
                $year = $parsedIssuedOn->format('Y'); // Year (e.g., 2024)
        } else {
            $day = '';
            $month = '';
            $year = '';
}
    @endphp

    <p class="left-text"  style="font-size: 16px;"><b>TO WHOM IT MAY CONCERN:</b></p>

    <p class="justified-text" style="text-indent: 50px;">This is to certify that <strong>{{$data[0]->resident_info->user_info->firstname}} {{$data[0]->resident_info->user_info->middle_initial }}, {{ $data[0]->resident_info->user_info->lastname}}</strong> of Barangay {{ $data[0]->resident_info->full_address }}, Oriental Mindoro is hereby granted <strong>PERMIT <u>{{ $permit_to }}</u></strong>
        for the period of <u>{{ $formattedPeriodDateOf }}</u> up to <u>{{ $formattedPeriodDateTo }}</u>.</p>
    <p class="justified-text" style="text-indent: 50px;">This <strong>PERMIT</strong> is good on the date and place specified above and this office reserves the rights and privileges to revoke this PERMIT wherever any of the existing laws, rules and regulation is violated.</p>
    <p class="justified-text" style="text-indent: 50px;">SIGNED AND ISSUED this <u>{{ $day }}</u> day of <u>{{ $month }}</u> 202<u>{{ substr($year, -1) }}</u> at Pag-asa, Bansud, Oriental Mindoro, Philippines.</p>
    
    
    <br><br>
    <br>
    <p class="right-text" style="font-size: 15px;"><strong>ARHUNFOL D. RODA</strong><br>Barangay Captain</p>

    <br>
    <br>
    <p class="center-text" style="font-size: 16px;"><i>Not valid without seal.</i></p>
</body>
</html>
