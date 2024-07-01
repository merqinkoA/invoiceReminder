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


        {{-- <!-- Indonesian Version -->
        <p>Hormat kami, <strong>{{ $emailData['vendor'] }}</strong> </p>
        <p>Semoga Anda dalam keadaan baik.</p>
        <p>Mohon bantuan Anda untuk mengirimkan Proforma <strong>{{ $emailData['current_month'] }}
                {{ $emailData['current_year'] }}</strong>.</p>
        <p>Terima kasih,</p>

        <!-- English Version -->
        <p>Dear, <strong>{{ $emailData['vendor'] }}</strong> </p>
        <p>Hope you are doing well.</p>
        <p>Please kindly need your help to submit Proforma
            <strong>{{ $emailData['current_month'] }} {{ $emailData['current_year'] }}</strong>.
        </p>
        <p>Thank you,</p> --}}
        <!-- Indonesian Version -->
        <p>Hormat kami, <u><strong>{{ $emailData['vendor'] }}</strong></u> </p>
        <p>Semoga Anda dalam keadaan baik.</p>
        <p>Mohon bantuannya untuk dapat mengirimkan Proforma/Draft Invoice Periode
            <u><strong>{{ $emailData['current_month'] }}
                    {{ $emailData['current_year'] }}</strong></u>.</p>
        <!-- <p>Batas waktu pengiriman file adalah tanggal 14 {{ $emailData['current_month'] }}
            {{ $emailData['current_year'] }}.</p> -->
        <p>Batas waktu pengiriman paling lambat tanggal 14 {{ $emailData['current_month'] }}
            {{ $emailData['current_year'] }}, melalui link
            (<u><strong>https://evim.sumbawatimurmining.com/</strong></u>).</p>
        <p>Harap tidak membalas email pemberitahuan ini.</p>
        <p>Terima kasih,</p>

        <!-- English Version -->
        <p><em>Dear, <u><strong>{{ $emailData['vendor'] }}</strong></u> </em></p>
        <p><em>Hope you are doing well.</em></p>
        <p><em>Please kindly need your help to submit Proforma/Draft Invoice Period (
                <u><strong>{{ $emailData['current_month'] }}
                        {{ $emailData['current_year'] }}</strong></u>.</em></p>
        <p><em>The due date for submitting the file is the 14th of {{ $emailData['current_month'] }}
                {{ $emailData['current_year'] }}.</em></p>
        <p><em>The deadline for submission is no later than the 14th, via the link
                (<u><strong>https://evim.sumbawatimurmining.com/</strong></u>).</em></p>
        <p><em>Kindly refrain from replying to this email reminder.</em></p>
        <p><em>Thank you,</p>
        <p class="footer">Best regards,<br>PT Vale Eksplorasi Indonesia<br>Sumbawa Timur Mining</p>
    </div>
</body>

</html>
