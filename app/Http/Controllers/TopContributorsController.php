<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Carbon\Carbon;

class TopContributorsController
{
    public function index()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $penggunas = Pengguna::withCount([
            'notes' => fn($q) => $q->whereBetween('created_at', [$start, $end]),
            'noteComments' => fn($q) => $q->whereBetween('created_at', [$start, $end]),
            'comments' => fn($q) => $q->whereBetween('created_at', [$start, $end]),
        ])
            ->get()
            ->map(function ($pengguna) {
                $pengguna->total_contributions =
                    ($pengguna->notes_count ?? 0) * 3 +
                    ($pengguna->note_comments_count ?? 0) * 2 +
                    ($pengguna->comments_count ?? 0) * 1;
                return $pengguna;
            })
            ->sortByDesc('total_contributions')
            ->take(10)
            ->values();

        $bulan_ini = Carbon::now()->isoFormat('MMMM YYYY');

        return view('topcontributors.index', compact('penggunas', 'bulan_ini'));
    }
}
