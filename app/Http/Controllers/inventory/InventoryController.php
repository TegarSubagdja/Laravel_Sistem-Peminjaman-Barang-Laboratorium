<?php

namespace App\Http\Controllers\inventory;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventoryController extends Controller
{
    //
    public function index()
    {
        return view('content.inventory.inventory-basic');
    }
}
