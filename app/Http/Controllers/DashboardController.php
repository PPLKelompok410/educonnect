<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Note;
use App\Models\Pengguna;
use App\Models\Payment;
use App\Models\MataKuliah;

class DashboardController extends Controller
{
    // Halaman utama dashboard
    public function index()
    {
        // Mengambil data user dari session
        $user = session('user');
        
        // Cek apakah tabel enrollments ada, jika tidak gunakan alternatif
        try {
            // Menghitung jumlah kelas aktif
            $activeClasses = DB::table('enrollments')
                ->where('pengguna_id', $user->id)
                ->where('status', 'active')
                ->count();
        } catch (\Exception $e) {
            // Jika tabel enrollments tidak ada, set ke 0 atau gunakan tabel alternatif
            $activeClasses = 0;
            // Alternatif jika Anda punya tabel lain, contoh:
            // $activeClasses = DB::table('user_classes')->where('user_id', $user->id)->count();
        }
        
        try {
            // Menghitung tugas yang belum dikerjakan
            $pendingAssignments = DB::table('assignments')
                ->join('enrollments', 'assignments.class_id', '=', 'enrollments.class_id')
                ->where('enrollments.pengguna_id', $user->id)
                ->whereNull('assignments.submitted_at')
                ->where('assignments.deadline', '>', now())
                ->count();
        } catch (\Exception $e) {
            // Jika query gagal, set ke 0
            $pendingAssignments = 0;
        }
        
        try {
            // Mengambil aktivitas terbaru
            $recentActivities = DB::table('activities')
                ->where('pengguna_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
        } catch (\Exception $e) {
            $recentActivities = collect(); // Empty collection
        }
        
        try {
            // Menghitung diskusi baru
            $newDiscussions = DB::table('discussions')
                ->join('enrollments', 'discussions.class_id', '=', 'enrollments.class_id')
                ->where('enrollments.pengguna_id', $user->id)
                ->where('discussions.created_at', '>', now()->subDays(7))
                ->count();
        } catch (\Exception $e) {
            $newDiscussions = 0;
        }
        
        try {
            // Mengambil 3 catatan terbaru
            $recentNotes = Note::with('matkul')
                ->where('user_id', $user->id)
                ->where('type', 'galeri')
                ->latest()
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $recentNotes = collect(); // Empty collection
        }
        
        return view('dashboard', compact(
            'user',
            'activeClasses',
            'pendingAssignments',
            'recentActivities',
            'newDiscussions',
            'recentNotes'
        ));
    }
    
    // Halaman profil pengguna
    public function profile()
    {
        $user = session('user');
        return view('dashboard.profile', compact('user'));
    }
    
    // Halaman daftar kelas
    public function classes()
    {
        $user = session('user');
        $classes = DB::table('classes')
            ->join('enrollments', 'classes.id', '=', 'enrollments.class_id')
            ->where('enrollments.pengguna_id', $user->id)
            ->get();
            
        return view('dashboard.classes', compact('user', 'classes'));
    }
    
    // Halaman daftar tugas
    public function assignments()
    {
        $user = session('user');
        $assignments = DB::table('assignments')
            ->join('enrollments', 'assignments.class_id', '=', 'enrollments.class_id')
            ->join('classes', 'assignments.class_id', '=', 'classes.id')
            ->where('enrollments.pengguna_id', $user->id)
            ->select('assignments.*', 'classes.name as class_name')
            ->orderBy('assignments.deadline')
            ->get();
            
        return view('dashboard.assignments', compact('user', 'assignments'));
    }
    
    // Halaman jadwal
    public function schedule()
    {
        $user = session('user');
        $schedules = DB::table('schedules')
            ->join('classes', 'schedules.class_id', '=', 'classes.id')
            ->join('enrollments', 'classes.id', '=', 'enrollments.class_id')
            ->where('enrollments.pengguna_id', $user->id)
            ->select('schedules.*', 'classes.name as class_name')
            ->orderBy('schedules.day')
            ->orderBy('schedules.start_time')
            ->get();
            
        return view('dashboard.schedule', compact('user', 'schedules'));
    }
    
    // Halaman nilai
    public function grades()
    {
        $user = session('user');
        $grades = DB::table('grades')
            ->join('assignments', 'grades.assignment_id', '=', 'assignments.id')
            ->join('classes', 'assignments.class_id', '=', 'classes.id')
            ->where('grades.pengguna_id', $user->id)
            ->select('grades.*', 'assignments.title as assignment_title', 'classes.name as class_name')
            ->orderBy('classes.name')
            ->orderBy('assignments.title')
            ->get();
            
        return view('dashboard.grades', compact('user', 'grades'));
    }
    
    // Halaman diskusi
    public function discussions()
    {
        $user = session('user');
        $discussions = DB::table('discussions')
            ->join('classes', 'discussions.class_id', '=', 'classes.id')
            ->join('enrollments', 'classes.id', '=', 'enrollments.class_id')
            ->where('enrollments.pengguna_id', $user->id)
            ->select('discussions.*', 'classes.name as class_name')
            ->orderBy('discussions.created_at', 'desc')
            ->get();
            
        return view('dashboard.discussions', compact('user', 'discussions'));
    }
    
    public function adminDashboard()
    {
        try {
            // Get total counts
            $totalUsers = Pengguna::count();
            $totalUpgradePlans = Payment::count();
            $totalMatkul = MataKuliah::count();
            $totalNotes = Note::count();
        
            // Get monthly user growth
            $monthlyUsers = Pengguna::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        
            // Get mata kuliah distribution
            $matkulByProdi = MataKuliah::selectRaw('prodi, COUNT(*) as count')
                ->groupBy('prodi')
                ->get();
        
            // Pass all variables to the view
            return view('admin.dashboard', compact(
                'totalUsers',
                'totalUpgradePlans',
                'totalMatkul',
                'totalNotes',
                'monthlyUsers',
                'matkulByProdi'
            ));
        } catch (\Exception $e) {
            // Provide default values if queries fail
            return view('admin.dashboard', [
                'totalUsers' => 0,
                'totalUpgradePlans' => 0,
                'totalMatkul' => 0,
                'totalNotes' => 0,
                'monthlyUsers' => collect(),
                'matkulByProdi' => collect()
            ]);
        }
    }
}