<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all profiles from the database
        $profiles = Profil::all();

        // Return the view with the profiles data
        return view('profiles.index', compact('profiles'));
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
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:profiles,email',
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        // Create a new profile using the validated data
        Profil::create($request->all());

        // Redirect to the profile index page with a success message
        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the profile by its ID
        $profile = Profil::findOrFail($id);

        // Return the view with the profile data
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the profile by its ID
        $profile = Profil::findOrFail($id);

        // Return the form view for editing the profile
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:profiles,email,' . $id,
            'phone_number' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'bio' => 'nullable|string',
        ]);

        // Find the profile by ID
        $profile = Profil::findOrFail($id);

        // Update the profile with the validated data
        $profile->update($request->all());

        // Redirect to the profile index page with a success message
        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the profile by ID
        $profile = Profil::findOrFail($id);

        // Delete the profile
        $profile->delete();

        // Redirect to the profile index page with a success message
        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
