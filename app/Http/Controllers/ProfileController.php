<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return Profile::all();
    }

    public function show($id)
    {
        return Profile::find($id);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:profiles']);

        $profile = Profile::create($request->all());

        return response()->json(['profile' => $profile], 201);
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());

        return response()->json(['profile' => $profile]);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Profile deleted']);
    }
}
