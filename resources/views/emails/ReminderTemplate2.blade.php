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
                <h2>Invoice Reminder</h2>
            </div>
        </div>
        <p>Dear, {{ $emailData['vendor'] }}</p>
        <p>Hope you are doing well.</p>
        <p>Please kindly need your help to submit Final
            Invoice {{ $emailData['current_month'] }} {{ $emailData['current_year'] }}.</p>
        <p>Thank you,</p>
        <p class="footer">Best regards,<br>PT Vale Eksplorasi Indonesia<br>Sumbawa Timur Mining</p>
    </div>
</body>

</html>
