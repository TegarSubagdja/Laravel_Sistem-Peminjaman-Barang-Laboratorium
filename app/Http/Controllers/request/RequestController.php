<?php

namespace App\Http\Controllers\request;

use App\Models\Loan;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
  //Index
  public function index()
  {
    return view('content.request.request-bacis');
  }

  public function getRequest()
  {
    $dataRequest = Loan::with(['user', 'item'])->get();

    // return view('loans.index', ['loans' => $dataRequest]);
    return view('content.request.request-bacis', compact('dataRequest'));
  }
}
