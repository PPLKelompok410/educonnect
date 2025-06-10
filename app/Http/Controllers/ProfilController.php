<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ProfilController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        $user = Pengguna::find(session('user')->id);

        // Ubah dari firstOrNew ke firstOrCreate
        $profile = Profil::firstOrCreate(
            ['pengguna_id' => $user->id],
            ['phone_number' => null, 'address' => null, 'bio' => null]
        );

        return view('profiles.index', compact('profile', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the form view for creating a new profile
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bio' => 'required|string|max:200',
            'address' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        try {
            $validatedData['pengguna_id'] = session('user')->id;
            Profil::create($validatedData);
            return redirect()->route('profiles.index')->with('success', 'Biodata berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profil $profile)
    {

        if (!session()->has('user')) {
            return redirect()->route('auth.login');
        }

        // Retrieve the profile by its ID
        $profile = Profil::findOrFail($profile);

        // Return the view with the profile data
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Pengguna::find(session('user')->id);
        $profile = Profil::firstOrNew(['pengguna_id' => $user->id]);
        return view('profiles.edit', compact('user', 'profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profil $profile)
    {
        $user = Pengguna::find(session('user')->id);

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
        ]);

        try {
            // Update user data
            $user->update([
                'full_name' => $validatedData['full_name'],
            ]);

            // Update or create profile
            $profile = Profil::updateOrCreate(
                ['pengguna_id' => $user->id],
                [
                    'bio' => $validatedData['bio'] ?? '-',
                    'address' => $validatedData['address'] ?? '-',
                    'phone_number' => $validatedData['phone_number'] ?? '-',
                ]
            );

            session()->put('user', $user);
            return redirect()->route('profiles.index')->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui profil.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profil $profile)
    {
        try {
            // Get the currently logged in user
            $user = Pengguna::find(session('user')->id);

            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }

            // Delete associated profile first (due to foreign key constraint)
            Profil::where('pengguna_id', $user->id)->delete();

            // Delete the user
            $user->delete();

            // Clear the session
            session()->forget('user');

            return redirect()->route('landing')->with('success', 'Akun berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus akun. ' . $e->getMessage());
        }
    }
}
