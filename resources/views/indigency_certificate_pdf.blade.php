<!DOCTYPE html>
<html>
<head>
    <title>Certificate of Indigency</title>
    <style>
        body {
            font-family: 'Century Gothic';
            margin: 0; /* Remove default body margin */
            padding: 0; /* Remove default body padding */
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
        .left-column {
            width: 40%;
            vertical-align: top;
            font-size: 14px;
            line-height: 1.5;
            text-align: center;
            padding: 5px;
        }
        .right-column {
            width: 60%;
            vertical-align: top;
            font-size: 17px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 0;
        }
        .left-column p, .right-column p {
            margin: 2px 0; /* Minimize margin-top and margin-bottom */
        }
        .right-column p {
            text-indent: 50px; /* Indent the first line of each paragraph */
        }
        @media print {
        table {
            width: 100%; /* Ensure the table fits within the page */
            table-layout: fixed; /* Avoid unexpected layout issues */
        }

        .left-column p {
            margin-bottom: 10px;
            page-break-inside: avoid;
        }
    }
    .indigency-text {
        text-align: center;
        font-size: 20px;
        line-height: 0.5;
        margin-top: 5px;
        text-decoration: underline;
        text-decoration-color: #039303; /* Underline color matches the text color */
    }
    .indigency-text strong {
        color: #039303; /* Text color */
    }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.png" class="logo" alt="Top Left Logo" style="float: left;">
        <img src="path_to_top_right_logo.png" class="logo" alt="Top Right Logo" style="float: right;">
        <p style="font-size: 17px;">Republic of the Philippines<br>Province of Oriental Mindoro<br>Municipality of Bansud<br><strong style="color: #1e1f1e;">BARANGAY PAG-ASA</strong></p>
        <hr class="headerline1" style="width: 100%; border: none; border-bottom: 1px solid #964B00;">
        <hr class="headerline2" style="width: 100%; border: none; border-bottom: 3px solid #964B00;">
    </div>
    @php
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
    <br>
    <p style="text-align: center; font-size: 20px; line-height: 0.5; margin-top: 5px;"><strong>TANGGAPAN NG PUNONG BARANGAY</strong></p><br>
    <p class="indigency-text"><strong>INDIGENCY</strong></p>
    <br>
    <table>
        <tr>
            <td class="left-column">
                <p><strong> Arhunfol D. Roda </strong><br>Barangay Captain</p>
                <p><strong> Hon. Mark R. Macalindong </strong><br>Councilman<br>Committee on Peace & Order</p>
                <p><strong> Hon. Babylinda F. De Castro </strong><br>Councilman<br>Committee on Infrastructure</p>
                <p><strong> Hon. Marygin B. Lasac </strong><br>Councilman<br>Committee on Education</p>
                <p><strong> Hon. Arian Glare L. Cabral </strong><br>Councilwoman<br>Committee on Finance</p>
                <p><strong> Hon. Allen Zyrus M. Lingon </strong><br>Councilman<br>Committee on Agriculture</p>
                <p><strong> Hon. Edmario L. Malapit </strong><br>Councilman<br>Committee on Clean & Green</p>
                <p><strong> Hon. Jinalyn S. Salazar </strong><br>Councilman<br>Committee on Health</p>
                <p><strong> Hon. Mark Jerome M. Fronda </strong><br>SK Chairperson<br>Committee on Sports</p>
                <p><strong> Mr. Jake P. Ilagan </strong><br>Barangay Secretary</p>
                <p><strong> Mr. Ronald N. Mahaba </strong><br>Barangay Treasurer</p>
            </td>
            <td class="right-column">
                <p><strong style="margin-bottom: 10px; margin-left: 40px;">SA SINUMANG KINAUUKULAN:</strong></p>
                <br>
                <br>
                
                <p style="margin-left: 80px; line-height: 1.5; margin-right: 40px;">Ito ay nagpapatunay na si <span style="text-transform: capitalize"><u>{{ $name }}</u></span> may sapat na gulang at lehitimong mamamayan ng Barangay Pag-asa, Bansud Oriental Mindoro.</p>
                <p style="text-align: justify; margin-left: 80px; line-height: 1.5; margin-right: 40px;">Ang pagpapatunay na ito ay isinagawa upang patotohanan ang kanyang tunay na kalagayan at upang magamit sa kanyang paghingi ng tulong mula sa alinmang ahensya o tanggapang pamahalaan at pribadong indibiduwal o sa anumang paggamit ng legal na naaayon sa mga umiiral na batas.</p>
                <p style="text-align: justify; margin-left: 80px; line-height: 1.5; margin-right: 40px;">Ipinagkaloob at nilagdaan ngayong ika-<u>{{ $day }}</u> ng <u>{{ $month }}</u>, <u>{{ $year }}</u> dito sa Barangay Pag-asa, Bansud, Oriental Mindoro.</p>
                <br>
                <p style="margin-left: 7%; margin-top: 10px; line-height: 1.5;">Nagpapatunay,</p><br>
                <br>
                <p style="margin-left: 30%; line-height: 0.5; margin-top: 5px;"><strong>ARHUNFOL D. RODA</strong></p>
                <p style="margin-left: 37%; line-height: 0.5; margin-top: 5px;">Punong Barangay</p>
            </td>
        </tr>
    </table>

    <p style="font-size: 15px; text-align: center; font-size: 16px; margin-top: 90px;"><span><i>Not Valid Without Sealed.</i></span></p>
</body>
</html>
