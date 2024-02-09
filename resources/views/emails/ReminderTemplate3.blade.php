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
            <img src="https://sumbawatimurmining.co.id/wp-content/uploads/2020/04/stm-logo-280.png" alt="Logo">
            <h2>Invoice Reminder</h2>
        </div>
        <p>Dear Finance Team,</p>
        <p>Kindly reminder to process IT Invoice:</p>
        <table class="data-table">
            <thead>
                <tr>

                    <th>Vendor</th>
                    <th>Invoice Number</th>
                    <th>Net Value</th>
                    <th>Currency</th>
                    <th>PO Number</th>
                    <th>SES Number</th>
                    <th>Invoice Submit Date</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through your data and populate the table rows here -->

                <tr>

                    <td>{{ $emailData['vendor'] }}</td>
                    <td>{{ $emailData['invoice_number'] }}</td>
                    <td>{{ $emailData['net_value'] }}</td>
                    <td>{{ $emailData['currency'] }}</td>
                    <td>
                        {{ $emailData['po_number'] }}
                    </td>
                    <td>
                        {{ $emailData['ses_migo_number'] }}
                    </td>
                    <td>{{ $emailData['current_month'] . $emailData['current_year'] }}</td>
                </tr>

            </tbody>
        </table>
        <p>Thank you for your cooperation.</p>
        <p class="footer">Best regards,<br>Sumbawa Timur Mining</p>
    </div>
</body>

</html>
