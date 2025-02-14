<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        .payslip-container {
            border: 1px solid #ccc;
            padding: 20px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
        }
        .staff-details {
            margin-bottom: 20px;
        }
        .staff-details h5 {
            margin: 0;
        }
        .salary-details {
            margin-top: 20px;
        }
        .salary-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .salary-details th, .salary-details td {
            padding: 8px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="payslip-container">
    <div class="header">
        <h2>Payslip from </strong> {{ $staff->business->business_name }}</h2>
        <p>Generated on: {{ now()->format('d M Y') }}</p>
    </div>

    <div class="staff-details">
        <h5>Name: {{ $staff->name }}</h5>
        <h5>Staff ID: {{ $staff->staff_id }}</h5>
        <h5>Role: {{ $staff->role }}</h5>
        <h5>Department: {{ $staff->department }}</h5>
        <h5>Payment For: {{ \Carbon\Carbon::parse($payslip->date)->format('d M Y')}}</h5>
    </div>

    <div class="salary-details">
        <h5>Salary Details:</h5>
        <table>
            <tr>
                <th>Basic Salary</th>
                <td>NGN {{ number_format($payslip->basic_salary, 2) }}</td>
            </tr>
            <tr>
                <th>Bonus</th>
                <td>NGN {{ number_format($payslip->bonus, 2) }}</td>
            </tr>
            <tr>
                <th>Total Salary</th>
                <td>NGN {{ number_format($payslip->amount, 2) }}</td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
