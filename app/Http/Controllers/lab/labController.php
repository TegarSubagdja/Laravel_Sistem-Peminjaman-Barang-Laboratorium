<?php

namespace App\Http\Controllers\lab;

use App\Models\Lab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class labController extends Controller
{
  //
  public function add(Request $request)
  {
    try {
      Lab::create([
        'name' => $request->nameLab,
        'location' => $request->locationLab,
      ]);
      return redirect()->back()->with('succes', 'Lab berhasil ditambahkan');
    } catch (\Throwable $th) {
      return redirect()->back()->with('errors', 'Lab gagal ditambahkan');
    }
  }

  public function update(Request $request, $id)
  {
    try {
      $lab = Lab::find($id);

      $lab->name = $request->nameLab;
      $lab->location = $request->locationLab;

      $lab->save();
      return redirect()->back()->with('succes', 'Lab berhasil di update');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Lab gagal di update');
    }
  }

  public function delete($id)
  {
    try {
      $lab = Lab::find($id);
      $lab->delete();

      return redirect()->back()->with('succes', 'Lab berhasil dihapus');
    } catch (\Throwable $th) {
      return redirect()->back()->with('errors', 'Lab gagal dihapus');
    }
  }
}
