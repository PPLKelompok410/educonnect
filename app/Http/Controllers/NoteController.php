<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\MataKuliah;
use App\Models\NoteRating;
use App\Models\NoteFile;
use App\Models\Pengguna;
use App\Models\Transaction;
use App\Models\DownloadLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class NoteController
{
    public function index(MataKuliah $matkul)
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        $notes = Note::with(['user', 'bookmarks'])
            ->where('matkul_id', $matkul->id)
            ->where('type', 'galeri')
            ->latest()
            ->get();

        return view('notes.index', compact('notes', 'matkul'));
    }

    public function create(MataKuliah $matkul)
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        return view('notes.create', compact('matkul'));
    }

    public function store(Request $request, MataKuliah $matkul)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'files.*' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:10240', // max 10MB
        ]);

        // Buat Note dulu
        $note = Note::create([
            'user_id' => session('user')->id,
            'judul' => $request->judul,
            'matkul_id' => $matkul->id,
            'deskripsi' => $request->deskripsi,
        ]);

        foreach ($request->file('files') as $file) {
            // Buat nama unik
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pindahkan file ke public/uploads/catatan
            $file->move(public_path('uploads/catatan'), $filename);

            // Simpan path relatif ke DB
            $note->files()->create([
                'file_path' => 'uploads/catatan/' . $filename
            ]);
        }

        return redirect()->route('notes.index', $note->matkul_id)->with('success', 'Catatan berhasil dibuat.');
    }


    public function show($id)
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        $note = Note::findOrFail($id);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'new_files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:10240', // max 10MB
            'deleted_files' => 'nullable|json', // karena dikirim sebagai JSON string
        ]);

        // Proses file yang dihapus
        if ($request->filled('deleted_files')) {
            $deletedFileIds = json_decode($request->deleted_files, true);
            if (is_array($deletedFileIds) && !empty($deletedFileIds)) {
                $filesToDelete = $note->files()->whereIn('id', $deletedFileIds)->get();
                foreach ($filesToDelete as $file) {
                    // Hapus file dari storage
                    if (file_exists(public_path($file->file_path))) {
                        unlink(public_path($file->file_path));
                    }
                    $file->delete(); // Hapus dari DB
                }
            }
        }

        if ($request->hasFile('new_files')) {
            foreach ($request->file('new_files') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Pindahkan file ke public/uploads/catatan
                $file->move(public_path('uploads/catatan'), $filename);

                // Simpan path relatif ke DB
                $note->files()->create([
                    'file_path' => 'uploads/catatan/' . $filename
                ]);
            }
        }

        $note->judul = $request->judul;
        $note->deskripsi = $request->deskripsi;
        $note->save();

        return redirect()->route('notes.show', $note->id)->with('success', 'Gambar berhasil diperbarui.');
    }

    public function destroy(Note $note)
    {
        // Hapus file catatan jika ada
        if ($note->file_path && Storage::disk('public')->exists($note->file_path)) {
            Storage::disk('public')->delete($note->file_path);
        }

        // Hapus catatan dari database
        $note->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('notes.index', $note->matkul_id)->with('success', 'Catatan berhasil dihapus.');
    }

    public function rate(Request $request, Note $note)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $userId = session('user')->id;

        // Update or create rating
        NoteRating::updateOrCreate(
            ['note_id' => $note->id, 'user_id' => $userId],
            ['rating' => $request->rating]
        );

        // Optional: update average rating in notes table
        $note->rating = $note->averageRating();
        $note->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'rating' => $note->rating]);
        }

        return redirect()->back()->with('success', 'Rating berhasil diberikan.');
    }

    public function incrementDownload(Note $note)
    {
        // Log awal untuk debugging
        \Log::info('incrementDownload called', [
            'note_id' => $note->id,
            'session_user_id' => session('user_id'),
            'has_session' => session()->has('user_id')
        ]);
    
        if (!session()->has('user_id')) {
            \Log::warning('No user_id in session');
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        try {
            $user = Pengguna::find(session('user_id'));
            \Log::info('User found', ['user' => $user ? $user->toArray() : null]);
        
            if (!$user) {
                \Log::error('User not found', ['user_id' => session('user_id')]);
                return response()->json(['error' => 'User not found'], 404);
            }
        
            // Cek/buat record download limit (TANPA DB TRANSACTION DULU)
            $downloadLimit = DownloadLimit::where('user_id', $user->id)->first();
            \Log::info('Existing download limit', ['download_limit' => $downloadLimit ? $downloadLimit->toArray() : null]);
        
            if (!$downloadLimit) {
                $downloadLimit = new DownloadLimit();
                $downloadLimit->user_id = $user->id;
                $downloadLimit->download_count = 0;
                $downloadLimit->last_download_reset = now();
                $downloadLimit->save();
                \Log::info('Created new download limit', ['download_limit' => $downloadLimit->toArray()]);
            }
        
            // Reset counter jika sudah hari baru
            $shouldReset = $downloadLimit->shouldResetToday();
            \Log::info('Should reset today?', [
                'should_reset' => $shouldReset,
                'last_reset' => $downloadLimit->last_download_reset,
                'current_date' => now()->format('Y-m-d')
            ]);
        
            if ($shouldReset) {
                $downloadLimit->download_count = 0;
                $downloadLimit->last_download_reset = now();
                $downloadLimit->save();
                \Log::info('Reset download limit', ['download_limit' => $downloadLimit->toArray()]);
            }
        
            // Tentukan maksimal download berdasarkan paket user
            $maxDownloads = $this->getMaxDownloads($user);
            \Log::info('Max downloads determined', [
                'max_downloads' => $maxDownloads,
                'current_count' => $downloadLimit->download_count
            ]);
        
            // Cek apakah sudah mencapai limit
            if ($downloadLimit->download_count >= $maxDownloads) {
                \Log::warning('Download limit reached', [
                    'current_count' => $downloadLimit->download_count,
                    'max_downloads' => $maxDownloads
                ]);
                return response()->json([
                    'error' => 'Download limit reached'
                ], 403);
            }
        
            // Increment download counter
            $downloadLimit->download_count = $downloadLimit->download_count + 1;
            $downloadLimit->save();
            \Log::info('Incremented download count', ['new_count' => $downloadLimit->download_count]);
        
            $responseData = [
                'success' => true,
                'remaining_downloads' => $maxDownloads - $downloadLimit->download_count,
                'current_count' => $downloadLimit->download_count,
                'max_downloads' => $maxDownloads
            ];
        
            \Log::info('Returning success response', $responseData);
            return response()->json($responseData);
        
        } catch (\Exception $e) {
            \Log::error('Download increment error: ' . $e->getMessage(), [
                'user_id' => $user->id ?? null,
                'note_id' => $note->id,
                'trace' => $e->getTraceAsString()
            ]);
        
            return response()->json([
                'error' => 'Terjadi kesalahan saat memproses download: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Get maximum downloads based on user's package
     */
    private function getMaxDownloads($user)
    {
        try {
            $latestTransaction = Transaction::where('user_id', $user->id)
                ->with('payment')
                ->latest()
                ->first();
        
            \Log::info('Latest transaction', ['transaction' => $latestTransaction ? $latestTransaction->toArray() : null]);
        
            $maxDownloads = 3; // Default untuk user gratis
        
            if ($latestTransaction && $latestTransaction->payment) {
                $package = $latestTransaction->payment->package;
                \Log::info('User package', ['package' => $package]);
            
                switch ($package) {
                    case 'Genius':
                        $maxDownloads = 5;
                        break;
                    case 'Professor':
                        $maxDownloads = 10;
                        break;
                    default:
                        $maxDownloads = 3;
                }
            }
        
            \Log::info('Final max downloads', ['max_downloads' => $maxDownloads]);
            return $maxDownloads;
        } catch (\Exception $e) {
            \Log::error('Error getting max downloads: ' . $e->getMessage());
            return 3; // Default jika error
        }
    }
}
