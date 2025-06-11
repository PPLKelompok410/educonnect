<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect - Upgrade Plan</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .font-opensans { font-family: 'Open Sans', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .text-primary { color: #2563eb; }
        .bg-primary { background-color: #2563eb; }
        .border-primary { border-color: #2563eb; }
        
        .plan-card {
            transition: all 0.3s ease;
        }
        
        .plan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.1), 0 10px 10px -5px rgba(37, 99, 235, 0.04);
        }

        .feature-list li {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-50">
@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Current Subscription Status -->
    @php
    $userTransaction = \App\Models\Transaction::where('user_id', session('user_id'))
        ->with('payment')
        ->orderBy('created_at', 'desc')
        ->first();
    @endphp
    
    @if($userTransaction && $userTransaction->payment)
    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-blue-100 rounded-full p-3">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold font-opensans text-gray-900">
                        Paket Aktif: {{ $userTransaction->payment->package }}
                    </h3>
                    <p class="text-sm text-gray-600 font-poppins">
                        Diaktifkan pada {{ $userTransaction->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
            
            <form action="{{ route('subscription.cancel') }}" 
                  method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan langganan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-50 text-red-600 rounded-lg font-medium hover:bg-red-100 transition-colors duration-200">
                    Batalkan Langganan
                </button>
            </form>
        </div>
    </div>
    @endif
    <!-- Header Section -->
    <div class="text-center mb-16">
        <h1 class="text-4xl font-bold text-gray-900 font-opensans mb-4">
            Upgrade Your Learning Experience
        </h1>
        <p class="text-lg text-gray-600 font-poppins max-w-2xl mx-auto">
            Choose the perfect plan that suits your learning needs and unlock premium features
        </p>
    </div>
    <!-- Plans Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($payments as $packageType => $packagePayments)
            @foreach($packagePayments as $payment)
                <div class="plan-card bg-white rounded-2xl overflow-hidden border border-gray-200">
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 font-opensans mb-2">
                                Paket {{ $payment->package }}
                            </h3>
                            <div class="flex items-center justify-center gap-1">
                                <span class="text-3xl font-bold text-primary font-opensans">
                                    Rp {{ number_format($payment->price, 0, ',', '.') }}
                                </span>
                                <span class="text-gray-500 font-poppins">/bulan</span>
                            </div>
                        </div>
                        <div class="mb-8">
                            <p class="text-gray-600 font-poppins text-sm mb-4">
                                {{ $payment->description ?? 'Tingkatkan pengalaman belajarmu dengan fitur premium' }}
                            </p>
                            <ul class="feature-list font-poppins text-sm">
                                @if($payment->package == 'Genius')
                                <li><svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Akses ke semua materi premium
                                </li>
                                <li><svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Konsultasi dengan tutor
                                </li>
                                @else
                                <li><svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Semua fitur Genius
                                </li>
                                <li><svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Prioritas bantuan 24/7
                                </li>
                                <li><svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Sertifikat digital
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="flex items-center gap-4">
                            <a href="#" onclick="selectPlan('{{ $payment->id }}')" 
                            class="w-full bg-primary hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg text-center font-poppins transition duration-200">
                                Pilih Paket
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
<script>
    function selectPlan(planId) {
        window.location.href = `/checkout/${planId}`;
    }
</script>
@endsection
</body>
</html>