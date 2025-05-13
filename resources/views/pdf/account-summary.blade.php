<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts Summary</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            /* background-color: #1e1e2c; */
            color: #1e1e2c;;
            margin: 0;
            padding: 20px;
        }

        .container {
            /* background-color: #1e1e2c; */
            padding: 20px;
            border: 2px solid #1e1e2c;
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #1e1e2c;;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #1e1e2c;;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1e1e2c;;
            color: #f29f67;
        }

        .totals {
            font-weight: bold;
            text-align: right;
            background-color: #1e1e2c;;
            color: #f29f67;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Accounts Summary</h1>
        <h3>For the period of {{ $date }}</h3>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (RS)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total Sales</td>
                    <td>{{ number_format($total_sales, 2) }}</td>
                </tr>
                <tr>
                    <td>Sales Payments Received</td>
                    <td>{{ number_format($total_sales_payments, 2) }}</td>
                </tr>
                <tr>
                    @php
                        $outstanding_receivables = $total_sales_payments - $total_sales;
                    @endphp
                    <td>Outstanding Receivables</td>
                    <td>{{ number_format($outstanding_receivables, 2) }}</td>
                </tr>
                <tr>
                    <td>Total Purchases</td>
                    <td>{{ number_format($total_purchases, 2) }}</td>
                </tr>
                <tr>
                    <td>Purchase Payments Made</td>
                    <td>{{ number_format($total_purchase_payments, 2) }}</td>
                </tr>
                <tr>
                    @php
                        $outstanding_payables = $total_purchase_payments - $total_purchases;
                    @endphp
                    <td>Outstanding Payables</td>
                    <td>{{ number_format($outstanding_payables, 2) }}</td>
                </tr>
                <tr>
                    <td class="totals">Net Cash Flow</td>
                    <td class="totals">{{ number_format($outstanding_receivables - $outstanding_payables, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
