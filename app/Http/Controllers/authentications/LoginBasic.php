<?php

namespace App\Http\Controllers\authentications;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginBasic extends Controller
{
  /**
   * Tampilkan halaman login.
   */
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }





  public function auth(Request $request)
  {
    $credentials = $request->validate([
      'identifier' => ['required'],
      'password' => ['required'],
    ]);

    // Buat validasi untuk memeriksa apakah 'identifier' adalah email atau tidak
    $isEmail = Validator::make($request->all(), [
      'identifier' => 'email',
    ])->passes();

    $fieldType = $isEmail ? 'email' : 'nrp';

    if (Auth::attempt([$fieldType => $credentials['identifier'], 'password' => $credentials['password']])) {
      $request->session()->regenerate();
      return redirect()->route('dashboard');
    }

    echo 'Validation Not Success';
    exit;  // Tambahkan exit untuk menghentikan eksekusi dan melihat hasilnya

    // Tambahkan pesan login gagal ke session
    session()->flash('error', 'The provided credentials do not match our records.');

    return back()->withErrors([
      'identifier' => 'The provided credentials do not match our records.',
    ])->onlyInput('identifier');
  }





  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
