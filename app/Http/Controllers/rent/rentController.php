<?php

namespace App\Http\Controllers\rent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class rentController extends Controller
{
  //

  public function rent(Request $req)
  {
    // Mengembalikan data dalam format JSON
    return response()->json([
      'success' => true,
      'data' => $req->all() // Mengembalikan semua data dari request
    ]);
  }
}
