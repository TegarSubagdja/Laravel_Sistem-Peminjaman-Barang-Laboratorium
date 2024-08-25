<?php

namespace App\Http\Controllers\authentications;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class resetPasswordController extends Controller
{
  //
  public function forgotView()
  {
    return view('auth.forgot-password');
  }

  public function sendResetLink(Request $request)
  {
    try {
      $request->validate(['email' => 'required|email']);

      $status = Password::sendResetLink(
        $request->only('email')
      );

      return $status === Password::RESET_LINK_SENT
        ? back()->with('status', 'Cek email untuk mengatur ulang password')
        : back()->withErrors(['email' => __($status)]);
    } catch (\Throwable $th) {
      return back()->with('error', 'Link reset gagal terkirim, pastikan email sudah benar!');
    }
  }

  public function resetView(Request $request, $token)
  {
    try {
      $email = $request->query('email');
      return view('content.authentications.auth-reset-password', ['token' => $token, 'email' => $email]);
    } catch (\Throwable $th) {
      return back()->with('error', 'Halaman mengakes halaman reset');
    }
  }

  public function resetPassword(Request $request)
  {
    try {
      $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
      ]);

      $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
          $user->forceFill([
            'password' => Hash::make($password)
          ])->setRememberToken(Str::random(60));

          $user->save();

          event(new PasswordReset($user));
        }
      );

      return $status === Password::PASSWORD_RESET
        ? redirect()->route('auth-login-basic')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
    } catch (\Throwable $th) {
      return back()->with('error', 'Gagal memperbarui password');
    }
  }
}
