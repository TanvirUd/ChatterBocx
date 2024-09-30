<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EditUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = User::find(auth()->user()->id);

        return view('editUser', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.auth()->user()->id]
        ]);

        auth()->user()->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }


}
