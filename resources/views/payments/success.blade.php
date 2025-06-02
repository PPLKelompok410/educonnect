<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - EduConnect</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-opensans { font-family: 'Open Sans', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .text-primary { color: #2563eb; }
        .bg-primary { background-color: #2563eb; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                    <circle class="opacity-25" cx="24" cy="24" r="20" stroke-width="4"/>
                    <path class="opacity-75" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M14 24l8 8 16-16"/>
                </svg>
                
                <h2 class="mt-4 text-2xl font-bold text-gray-900 font-opensans">Pembayaran Berhasil!</h2>
                <p class="mt-2 text-gray-600 font-poppins">
                    Terima kasih telah melakukan upgrade paket {{ $payment->package }}
                </p>

                <div class="mt-6 space-y-4">
                    <a href="{{ route('payments.receipt', $transaction->id) }}" 
                       class="inline-block w-full bg-primary text-white font-semibold py-3 px-6 rounded-lg text-center font-poppins hover:bg-blue-700 transition duration-200">
                        Download Bukti Pembayaran
                    </a>
                    
                    <a href="{{ route('dashboard') }}" 
                       class="inline-block w-full bg-gray-100 text-gray-700 font-semibold py-3 px-6 rounded-lg text-center font-poppins hover:bg-gray-200 transition duration-200">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>