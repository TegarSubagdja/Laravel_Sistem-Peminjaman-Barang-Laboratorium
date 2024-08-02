<?php

namespace App\Http\Controllers\request;

use App\Models\Loan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
  //Index
  public function index()
  {
    return view('content.request.request-basic');
  }

  public function getRequest()
  {
    $user = Auth::user();

    if ($user->isAdmin()) {
      // Ambil semua loans dengan relasi user dan item
      $requests = Loan::with(['user', 'item'])->get();
    } else {
      // Ambil loans yang terkait dengan user yang sedang login
      $requests = $user->loans()->with('item')->get();
    }

    return view('content.request.request-basic', compact('requests'));
  }
}
