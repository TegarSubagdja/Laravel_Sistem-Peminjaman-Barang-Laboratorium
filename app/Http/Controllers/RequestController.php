<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    //Index
    public function index()
    {
        return view('content.request.request-bacis');
    }
}
