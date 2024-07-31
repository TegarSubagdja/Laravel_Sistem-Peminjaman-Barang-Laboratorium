<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function register(Request $request)
  {
    // Buat user baru
    $user = User::create([
      'name' => $request->username,
      'email' => $request->email,
      'nrp' => $request->nrp,
      'password' => Hash::make($request->password),
      'role' => 'user'
    ]);

    // Login user
    Auth::login($user);

    // Regenerasi session
    $request->session()->regenerate();

    // Redirect ke halaman dashboard atau home
    return redirect()->route('dashboard');
  }
}
