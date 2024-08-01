<?php

namespace App\Http\Controllers\inventory;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InventoryController extends Controller
{
  //
  public function index()
  {
    $items = Item::with('lab')->paginate(9);
    return view('content.inventory.inventory-basic', compact('items'));
  }

  public function getItem(Request $req)
  {
    $item = Item::with('lab')->where('code', $req->decodeText)->first();

    return response()->json([
      'item' => $item,
    ]);
  }
}
