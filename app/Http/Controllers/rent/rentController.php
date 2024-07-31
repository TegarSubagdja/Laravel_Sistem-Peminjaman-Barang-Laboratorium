<?php

namespace App\Http\Controllers\rent;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class rentController extends Controller
{
  //

  public function rent(Request $request)
  {
    $loan = Loan::create([
      'user_id' => Auth::id(), // Mendapatkan user_id dari pengguna yang sedang login
      'item_id' => $request->code,
      'loan_date' => $request->date,
      'return_date' => $request->due,
      'status' => 'waiting',
    ]);

    return response()->json([
      'message' => 'Loan created successfully',
      'loan' => $loan
    ], 200);
  }
}
