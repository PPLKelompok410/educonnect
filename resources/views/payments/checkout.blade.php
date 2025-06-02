<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EduConnect - Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-opensans { font-family: 'Open Sans', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .text-primary { color: #2563eb; }
        .bg-primary { background-color: #2563eb; }
        .border-primary { border-color: #2563eb; }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('upgrade.plans') }}" class="flex items-center text-gray-600 hover:text-primary transition-colors">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span class="font-poppins">Kembali</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-900 font-opensans mb-2">Checkout</h1>
                <p class="text-gray-600 font-poppins">Selesaikan pembayaran untuk melanjutkan</p>
            </div>

            <!-- Order Summary -->
            <div class="p-8 bg-gray-50 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900 font-opensans mb-4">Ringkasan Pesanan</h2>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="font-poppins text-gray-600">Paket</span>
                        <span class="font-poppins font-medium">{{ $payment->package }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-poppins text-gray-600">Harga Paket</span>
                        <span class="font-poppins font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-poppins text-gray-600">Biaya Admin</span>
                        <span class="font-poppins font-medium">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-poppins text-gray-600">PPN (11%)</span>
                        <span class="font-poppins font-medium">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200 flex justify-between">
                        <span class="font-opensans font-bold text-lg">Total</span>
                        <span class="font-opensans font-bold text-lg text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Error Message Container -->
            <div id="error-container" class="hidden"></div>

            <!-- Payment Form -->
            <form action="{{ route('upgrade.process-payment', $payment->id) }}" method="POST" class="p-8" id="payment-form">
                @csrf
                <h2 class="text-xl font-bold text-gray-900 font-opensans mb-6">Metode Pembayaran</h2>

                <div class="space-y-4">
                    @foreach(['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri'] as $method)
                    <label class="relative flex items-center justify-between p-4 border rounded-lg cursor-pointer hover:border-primary transition-colors">
                        <div class="flex items-center">
                            <input type="radio" name="payment_method" value="{{ $method }}" class="h-4 w-4 text-primary border-gray-300 focus:ring-primary" required>
                            <span class="ml-3 font-poppins">{{ $method }}</span>
                        </div>
                    </label>
                    @endforeach

                    @error('payment_method')
                        <p class="text-red-500 text-sm font-poppins">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8">
                    <label class="flex items-center">
                        <input type="checkbox" name="agree_to_terms" class="h-4 w-4 text-primary border-gray-300 focus:ring-primary" required>
                        <span class="ml-3 font-poppins text-sm text-gray-600">
                            Saya setuju dengan syarat dan ketentuan yang berlaku
                        </span>
                    </label>
                    @error('agree_to_terms')
                        <p class="text-red-500 text-sm font-poppins mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" id="submit-btn" class="mt-8 w-full bg-primary hover:bg-blue-700 text-white font-semibold py-4 px-6 rounded-lg text-center font-poppins transition duration-200">
                    Bayar Sekarang
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('payment-form');
            const submitBtn = document.getElementById('submit-btn');
            const errorContainer = document.getElementById('error-container');

            // Function to show error message
            function showError(message) {
                errorContainer.innerHTML = `
                    <div class="mx-8 mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-poppins">${message}</span>
                        </div>
                    </div>
                `;
                errorContainer.classList.remove('hidden');
                errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // Function to hide error message
            function hideError() {
                errorContainer.classList.add('hidden');
                errorContainer.innerHTML = '';
            }

            // Function to reset button state
            function resetButton() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Bayar Sekarang';
            }

            // Function to show loading state
            function showLoading() {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 mr-3 inline-block" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses Pembayaran...
                `;
            }

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                hideError();

                // Validate form
                const paymentMethod = form.querySelector('input[name="payment_method"]:checked');
                const agreeTerms = form.querySelector('input[name="agree_to_terms"]:checked');

                if (!paymentMethod) {
                    showError('Silakan pilih metode pembayaran');
                    return;
                }

                if (!agreeTerms) {
                    showError('Anda harus menyetujui syarat dan ketentuan');
                    return;
                }

                showLoading();

                try {
                    const formData = new FormData(form);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                    console.log('Sending payment request...'); // Debug log

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin'
                    });

                    console.log('Response status:', response.status); // Debug log
                    console.log('Response headers:', response.headers); // Debug log

                    // Handle different response types
                    let data;
                    const contentType = response.headers.get('content-type');
                    
                    if (contentType && contentType.includes('application/json')) {
                        data = await response.json();
                        console.log('JSON Response:', data); // Debug log
                    } else {
                        const textResponse = await response.text();
                        console.log('Text Response:', textResponse); // Debug log
                        
                        // If it's HTML, it might be a redirect or error page
                        if (textResponse.includes('<!DOCTYPE html>')) {
                            throw new Error('Server mengembalikan halaman HTML. Periksa konfigurasi route dan controller.');
                        }
                        
                        try {
                            data = JSON.parse(textResponse);
                        } catch (parseError) {
                            throw new Error('Response tidak valid dari server');
                        }
                    }

                    if (response.ok) {
                        if (data.success) {
                            // Success - redirect to success page
                            console.log('Payment successful, redirecting to:', data.redirect_url);
                            window.location.href = data.redirect_url || '/upgrade/success';
                        } else {
                            throw new Error(data.message || 'Pembayaran gagal');
                        }
                    } else {
                        // Handle HTTP errors
                        if (data.errors) {
                            // Validation errors
                            const errorMessages = Object.values(data.errors).flat();
                            throw new Error(errorMessages.join(', '));
                        } else if (data.message) {
                            throw new Error(data.message);
                        } else {
                            throw new Error(`Server error (${response.status}). Silakan coba lagi atau hubungi administrator.`);
                        }
                    }

                } catch (error) {
                    console.error('Payment Error:', error);
                    resetButton();

                    let errorMessage = 'Terjadi kesalahan saat memproses pembayaran';
                    
                    if (error.name === 'TypeError' && error.message.includes('Failed to fetch')) {
                        errorMessage = 'Koneksi terputus. Periksa koneksi internet Anda dan coba lagi.';
                    } else if (error.message) {
                        errorMessage = error.message;
                    }

                    showError(errorMessage);
                }
            });

            // Add form validation on input change
            form.addEventListener('change', function() {
                hideError();
            });
        });
    </script>
</body>
</html>