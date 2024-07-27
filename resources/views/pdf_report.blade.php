<!DOCTYPE html>
<html>
<head>
    <title>Barangay Residents Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Barangay Residents Report</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Zone</th>
                <th>Civil Status</th>
                <th>Occupation</th>
                <th>Religion</th>
                <th>Educational Attainment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($residents as $resident)
                <tr>
                    <td>{{ $resident->name }}</td>
                    <td>{{ $resident->age }}</td>
                    <td>{{ $resident->gender }}</td>
                    <td>{{ $resident->zone }}</td>
                    <td>{{ $resident->civil_status }}</td>
                    <td>{{ $resident->occupation }}</td>
                    <td>{{ $resident->religion }}</td>
                    <td>{{ $resident->educational_attainment }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
