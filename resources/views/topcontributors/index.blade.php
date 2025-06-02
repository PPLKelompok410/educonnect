@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-12 px-4">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-blue-700 mb-2 flex justify-center items-center gap-2">
            <i class="bi bi-trophy-fill"></i> Top Contributors <i class="bi bi-trophy-fill"></i>
        </h1>
        <h2 class="text-2xl text-blue-600">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</h2>
    </div>

    <!-- Top 3 Podium -->
    <div class="flex justify-center items-end gap-6 flex-wrap my-8">
        @php
        $topThree = $penggunas->take(3);
        $podiumStyles = [
        ['rank' => 2, 'class' => 'bg-gradient-to-br from-gray-400 to-gray-300'], // Silver
        ['rank' => 1, 'class' => 'bg-gradient-to-br from-yellow-400 to-yellow-300 -translate-y-5'], // Gold
        ['rank' => 3, 'class' => 'bg-gradient-to-br from-yellow-800 to-yellow-700'], // Bronze
        ];
        @endphp

        @foreach ($podiumStyles as $style)
        @php $pengguna = $topThree[$style['rank'] - 1] ?? null; @endphp
        @if ($pengguna)
        <div class="w-48 p-6 text-white rounded-xl shadow-md text-center flex flex-col justify-center items-center {{ $style['class'] }} transition-transform hover:scale-105 min-h-[180px]">
            <h5 class="text-lg font-semibold mb-2">
                <i class="bi bi-award"></i> {{ $pengguna->nama ?? 'Tidak diketahui' }}
            </h5>
            <div class="flex items-center justify-center gap-4 text-base my-2">
                <span><i class="bi bi-journal-text"></i> {{ $pengguna->notes_count }}</span>
                <span><i class="bi bi-chat-dots"></i> {{ $pengguna->note_comments_count }}</span>
                <span><i class="bi bi-people"></i> {{ $pengguna->comments_count }}</span>
            </div>
            <div class="text-xl font-bold mt-2">{{ $pengguna->total_contributions }}</div>
        </div>
        @endif
        @endforeach
    </div>

    <!-- Rank 4 - 10 Cards -->
    @php $rank = 4; @endphp
    @foreach ($penggunas->skip(3)->take(7) as $pengguna)
    <div class="bg-white border-l-8 border-blue-600 shadow-md p-4 rounded-lg mb-4 flex flex-wrap justify-between items-center">
        <div class="flex items-center gap-6">
            <span class="text-blue-700 font-bold text-lg">#{{ $rank++ }}</span>
            <span class="text-gray-800">{{ $pengguna->nama ?? 'Tidak diketahui' }}</span>
        </div>
        <div class="flex items-center gap-4">
            <span><i class="bi bi-journal-text text-blue-600"></i> {{ $pengguna->notes_count }}</span>
            <span><i class="bi bi-chat-dots text-blue-600"></i> {{ $pengguna->note_comments_count }}</span>
            <span><i class="bi bi-people text-blue-600"></i> {{ $pengguna->comments_count }}</span>
            <div class="w-12 h-12 flex items-center justify-center bg-white text-blue-600 font-bold rounded-full shadow">
                {{ $pengguna->total_contributions }}
            </div>
        </div>
    </div>
    @endforeach

    <!-- Legend -->
    <div class="mt-10 bg-white p-6 rounded-lg shadow-md flex flex-wrap justify-center gap-6 text-blue-700 text-sm">
        <div class="flex items-center gap-2"><i class="bi bi-journal-text"></i> Catatan</div>
        <div class="flex items-center gap-2"><i class="bi bi-chat-dots"></i> Komentar Catatan</div>
        <div class="flex items-center gap-2"><i class="bi bi-people"></i> Komentar Forum</div>
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full shadow flex items-center justify-center bg-white text-blue-700 font-bold">#</div> Total Kontribusi
        </div>
    </div>
</div>
@endsection