<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant and Accused Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center">Applicant and Accused Details</h2>
    <table >
        <thead>
            <tr>
                <th>ID</th>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Complaint</th>
                <th>Accused Name</th>
                <th>Accused Email</th>
                <th>Accused Phone No.</th>
                <th>Current Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($complaints as $value)
                <tr>
                    <th>{{ $value->id }}</th>
                    <td>{{ $value->complaint_fname }}</td>
                    <td>{{ $value->complaint_email }}</td>
                    <td>{{ $value->complaint_phone_no }}</td>
                    <td>{{ $value->complaint_body }}</td>
                    <td>{{ $value->accused_name }}</td>
                    <td>{{ $value->accused_email }}</td>
                    <td>{{ $value->accused_phone_no }}</td>
                    <td>{{ $value->status }}</td>
                </tr>
                @endforeach 
        </tbody>
    </table>
</body>
</html>













<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipper and Customer Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<body>
    <h2 style="text-align:center">Applicant Details</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Applicant Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Complaint</th>
            </tr>
        </thead>
        <tbody>
        @foreach($complaints as $value)
            <tr>
                    <th>{{ $value->id }}</th>
                    <td>{{ $value->complaint_fname }}</td>
                    <td>{{ $value->complaint_email }}</td>
                    <td>{{ $value->complaint_phone_no }}</td>
                    <td>{{ $value->complaint_body }}</td>
            </tr>
        @endforeach 
        </tbody>
    </table>

    <h2 style="text-align:center">Accused Details</h2>
    <table>
        <thead>
            <tr> 
                <th>ID</th>
                <th>Accused Name</th>
                <th>Accused Email</th>
                <th>Accused Phone No.</th>
            </tr>
        </thead>
        <tbody>
        @foreach($complaints as $value)
                <tr>
                     <th>{{ $value->id }}</th>
                    <td>{{ $value->accused_name }}</td>
                    <td>{{ $value->accused_email }}</td>
                    <td>{{ $value->accused_phone_no }}</td>
                </tr>
        @endforeach 
        </tbody>
    </table>
</body>
</html>    -->
