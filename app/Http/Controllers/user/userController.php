<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function index()
  {
    return view('liveSearch');
  }

  public function search(Request $request)
  {
    $query = $request->get('query');

    $users = User::where('name', 'LIKE', "%{$query}%")
      ->orWhere('email', 'LIKE', "%{$query}%")
      ->orWhere('nrp', 'LIKE', "%{$query}%")
      ->get(['nrp', 'name']);

    return response()->json($users);
  }

  public function add(Request $request)
  {
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'nrp' => $request->nrp,
      'password' => Hash::make($request->password),
      'role' => $request->role,
    ]);

    return redirect()->back()->with('success', 'User berhasil disimpan');
  }

  public function delete($nrp)
  {
    $user = User::where('nrp', $nrp);

    if ($user) {
      $user->delete();
      return redirect()->back()->with('success', 'User berhasil dihapus');
    } else {
      return redirect()->back()->with('error', 'User tidak ditemukan');
    }
  }

  public function update(Request $request, $nrp)
  {
    // Ambil user berdasarkan NRP
    $user = User::where('nrp', $nrp)->first();

    if ($user) {
      // Update data user
      $user->name = $request->name;
      $user->email = $request->email;
      $user->nrp = $request->nrp;

      if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
      }

      $user->role = $request->role;
      $user->save();

      return redirect()->back()->with('success', 'User berhasil diperbarui');
    } else {
      return redirect()->back()->with('error', 'User tidak ditemukan');
    }
  }
}
