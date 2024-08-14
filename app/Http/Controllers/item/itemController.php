<?php

namespace App\Http\Controllers\item;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class itemController extends Controller
{
  //

  public function addItem(Request $request)
  {
    try {
      $item = new Item();
      $item->name = $request->name;
      $item->lab_id = $request->lab;
      $item->description = $request->description;
      $item->code = $request->code;

      if ($request->hasFile('picture')) {
        $file = $request->file('picture');
        $extension = $file->getClientOriginalExtension();
        $filename = $item->code . '.' . $extension;

        // Make directory if it doesn't exist
        if (!Storage::disk('public')->exists('assets/img/items')) {
          Storage::disk('public')->makeDirectory('assets/img/items');
        }

        $path = $file->storeAs('assets/img/items', $filename, 'public');
        $item->picture = basename($path);
      }

      $item->save();

      return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    } catch (\Exception $e) {
      Log::error('Error adding item: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Gagal menambahkan item!');
    }
  }


  public function updateItem(Request $request, $code)
  {
    try {
      $item = Item::where('code', $code)->firstOrFail();
      $item->name = $request->name;
      $item->lab_id = $request->lab;
      $item->description = $request->description;

      if ($request->hasFile('picture')) {
        // Hapus gambar lama jika ada
        if ($item->picture && Storage::disk('public')->exists('assets/img/items/' . $item->picture)) {
          Storage::disk('public')->delete('assets/img/items/' . $item->picture);
        }

        $file = $request->file('picture');
        $extension = $file->getClientOriginalExtension();
        $filename = $item->code . '.' . $extension;

        // Make directory if it doesn't exist
        if (!Storage::disk('public')->exists('assets/img/items')) {
          Storage::disk('public')->makeDirectory('assets/img/items');
        }

        $path = $file->storeAs('assets/img/items', $filename, 'public');
        $item->picture = basename($path);
      }

      $item->save();

      return redirect()->back()->with('success', 'Item berhasil diperbarui!');
    } catch (\Exception $e) {
      Log::error('Error updating item: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Gagal memperbarui item!');
    }
  }

  public function deleteItem($code)
  {
    try {
      $item = Item::where('code', $code)->firstOrFail();

      // Hapus gambar terkait jika ada
      if ($item->picture && Storage::disk('public')->exists('assets/img/items/' . $item->picture)) {
        Storage::disk('public')->delete('assets/img/items/' . $item->picture);
      }

      // Hapus item dari database
      $item->delete();

      return redirect()->back()->with('success', 'Item berhasil dihapus!');
    } catch (\Exception $e) {
      Log::error('Error deleting item: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Gagal menghapus item!');
    }
  }
}
