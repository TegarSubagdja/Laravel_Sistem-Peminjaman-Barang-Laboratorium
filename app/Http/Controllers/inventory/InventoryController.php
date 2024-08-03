<?php

namespace App\Http\Controllers\inventory;

use App\Models\Item;
use App\Models\Lab;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
  //
  public function index(Request $request)
  {
    $search = $request->input('search');

    if ($search) {
      $items = Item::search($search)->paginate(9);
    } else {
      $items = Item::with('lab')->paginate(9);
    }

    $labs = Lab::all();

    return view('content.inventory.inventory-basic', compact('items', 'labs'));
  }

  public function getItem(Request $req)
  {
    $item = Item::with('lab')->where('code', $req->decodeText)->first();

    return response()->json([
      'item' => $item,
    ]);
  }

  public function addItem(Request $request)
  {
    $item = new Item();
    $item->name = $request->name;
    $item->lab_id = $request->lab;
    $item->description = $request->description;
    $item->code = $request->code;

    if ($request->hasFile('picture')) {
      $file = $request->file('picture');
      $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
      $extension = $file->getClientOriginalExtension();
      $filename = Str::slug($filename);
      $counter = 1;
      $originalFilename = $filename;

      // Check if file already exists and add a counter if it does
      while (Storage::disk('public')->exists('assets/img/items/' . $filename . '.' . $extension)) {
        $filename = $originalFilename . '-' . $counter;
        $counter++;
      }

      $filename = $filename . '.' . $extension;

      // Make directory if it doesn't exist
      if (!Storage::disk('public')->exists('assets/img/items')) {
        Storage::disk('public')->makeDirectory('assets/img/items');
      }

      $path = $file->storeAs('assets/img/items', $filename, 'public');

      // Logging for debugging
      Log::info('File stored at: ' . $path);

      $item->picture = basename($path);
    }

    $item->save();

    return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
  }
}
