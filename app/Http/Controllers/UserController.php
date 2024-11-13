<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(Request $request) {
        return response()->json($request->user());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'profile_id' => 'required|exists:profiles,id'
        ]);

    
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
    
        return response()->json(['message' => 'Usuário criado com sucesso', 'user' => $user], 201);
    }

    public function update(Request $request) {
        $user = $request->user();
    
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:3|confirmed'
        ]);
    
        if ($user->profile && $user->profile->name === 'admin') {
            $adminData = $request->validate([
                'profile_id' => 'sometimes|exists:profiles,id'
            ]);
    
            $data = array_merge($data, $adminData);
        }
    
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
    
        $user->update($data);
    
        return response()->json(['message' => 'Informações atualizadas com sucesso', 'user' => $user]);
    }
}
