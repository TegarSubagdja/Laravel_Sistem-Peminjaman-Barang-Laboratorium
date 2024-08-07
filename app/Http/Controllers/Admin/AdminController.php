<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  //
  public function index()
  {
    $users = User::all();
    $items = Item::all();

    return view('content.Admin.Admin-basic', compact('users', 'items'));
  }
}
