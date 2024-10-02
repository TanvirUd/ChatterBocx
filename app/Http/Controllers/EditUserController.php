<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditUserController extends Controller
{

    use ConfirmsPasswords;

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

    public function showDeletePage()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        return view('delete');
    }

    public function delete()
    {
        auth()->user()->delete();
        return redirect('/');
    }

    /************** PARTI UPDATE PASSWORD  /**************/
    public function showPasswordPage()
    {
        $user = User::find(auth()->user()->id);

        return view('modifyPassword', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        // Vérifiez si le mot de passe actuel est correct
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Le mot de passe actuel is not gut']);
        }

        // Valider les nouveaux mots de passe
        $request->validate([
            'new_password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);

        // Mettre à jour le mot de passe de l'utilisateur
        auth()->user()->password = bcrypt($request->new_password);
        auth()->user()->save();

        return redirect()->route('dashboard')->with('success', 'Mot de passe modifié avec succès.');
    }


}
