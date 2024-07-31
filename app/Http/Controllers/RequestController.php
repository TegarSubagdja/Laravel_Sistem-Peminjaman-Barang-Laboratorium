<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Loan;

class RequestController extends Controller
{
  //Index
  public function index()
  {
    return view('content.request.request-bacis');
  }

  public function getRequest()
  {
    $dataRequest = Loan::all();

    // return view('loans.index', ['loans' => $dataRequest]);
    return view('content.request.request-bacis', compact('dataRequest'));
  }
}
