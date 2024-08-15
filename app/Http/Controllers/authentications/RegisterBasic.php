<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
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
    try {
      $user = User::create([
        'name' => $request->username,
        'email' => $request->email,
        'nrp' => $request->nrp,
        'password' => Hash::make($request->password),
        'role' => 'user'
      ]);

      Auth::login($user);

      $request->session()->regenerate();

      return redirect()->route('dashboard');
    } catch (\Throwable $th) {
      Log::error('Error during user registration: ' . $th->getMessage());
      return redirect()->back()->with('error', 'Terjadi kesalahan dalam registrasi');
    }
  }
}
