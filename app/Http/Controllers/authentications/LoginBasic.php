<?php

namespace App\Http\Controllers\authentications;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
    try {
      $credentials = $request->validate([
        'identifier' => ['required'],
        'password' => ['required'],
      ]);

      $isEmail = Validator::make($request->all(), [
        'identifier' => 'email',
      ])->passes();

      $fieldType = $isEmail ? 'email' : 'nrp';

      if (Auth::attempt([$fieldType => $credentials['identifier'], 'password' => $credentials['password']])) {
        $request->session()->regenerate();
        Cache::put('waiting_loans_count', Loan::where('status', 'waiting')->count());
        return redirect()->route('dashboard');
      }
      return back()->with('error', 'Login gagal, Username atau Password salah!');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Terjadi kesalahan saat login, coba beberapa saat lagi');
    }
  }

  public function logout(Request $request)
  {
    try {
      Auth::logout();

      $request->session()->invalidate();

      $request->session()->regenerateToken();

      return redirect()->route('/auth/login-basic');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Terjadi Kesalahan, coba beberapa saat lagi');
    }
  }
}
