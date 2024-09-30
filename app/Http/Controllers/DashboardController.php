<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        if (!Auth::check())
        {
            return redirect()->route('login');
        }

        $user = User::where('id', auth()->id())->select([
            'id', 'name', 'email',
        ])->first();

        return view('dashboard', compact('user'));
    }
}
