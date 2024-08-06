<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Account has been {{ $request->new_status }}!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        @if($request->new_status == "Approved")
            <h1>Congratulations, {{ $request['first_name'] }} {{ $request['last_name'] }},!</h1>
            <p>Your account has been approved successfully. You can now log in and start using our services.</p>
        @elseif($request->new_status == "Disapproved") 
            <h1>Sorry, {{ $request['first_name'] }} {{ $request['last_name'] }},!</h1>
            <p>Your account has been disapproved. You cannot use our services.</p>
        @endif

        <p>If you have any questions, feel free to reach out to our support team.</p>
    </div>
</body>
</html>