<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
