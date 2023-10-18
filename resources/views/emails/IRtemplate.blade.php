<!DOCTYPE html>
<html>
<head>
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <h2>Email Template</h2> --}}
            <div class="header">

                <img src="https://sumbawatimurmining.co.id/wp-content/uploads/2020/04/stm-logo-280.png" alt="Logo">
                {{-- <img src = "{{asset('assets')}}/images/svg-loaders/hearts.svg" alt="My Happy SVG"/> --}}
                <h2>Invoice Reminder</h2></div>
        </div>
        <p>Dear Bapak/Bu {{ $emailData['supplier_name']}} </p>
        <p>Dengan Hormat,</p>
        <p>Mohon bantuannya untuk dapat disubmit promorma/draft invoice Periode {{ $emailData['pr_number'] }} </p>
        <table class="data-table">
            <tr>
                <th>PR Number</th>
                <td>{{ $emailData['pr_number'] }}</td>
            </tr>
            <tr>
                <th>Supplier Name</th>
                <td>{{ $emailData['supplier_name'] }}</td>
            </tr>
            <!-- Add more data rows as needed -->
        </table>
        <p>Thank you for using our service.</p>
        <p class="footer">Best regards,<br>Sumbawa Timur Mining</p>
    </div>
</body>
</html>
