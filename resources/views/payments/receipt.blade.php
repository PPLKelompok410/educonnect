<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .receipt-details {
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .total {
            font-weight: bold;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>EduConnect</h1>
            <h2>Bukti Pembayaran</h2>
        </div>

        <div class="receipt-details">
            <p><strong>No. Transaksi:</strong> {{ $transaction->transaction_id }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Nama:</strong> {{ $user->full_name }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $transaction->payment_method }}</p>
        </div>

        <table class="table">
            <tr>
                <th>Item</th>
                <th>Harga</th>
            </tr>
            <tr>
                <td>Paket {{ $payment->package }}</td>
                <td>Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Admin</td>
                <td>Rp {{ number_format($transaction->admin_fee, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>PPN (11%)</td>
                <td>Rp {{ number_format($transaction->tax, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Total</td>
                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div style="margin-top: 40px; text-align: center;">
            <p><strong>Status: LUNAS</strong></p>
            <p>Terima kasih telah berlangganan EduConnect!</p>
        </div>
    </div>
</body>
</html>