<?php

namespace App\Http\Controllers\request;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class RequestController extends Controller
{
  //Index
  public function index()
  {
    return view('content.request.request-basic');
  }

  public function getRequest()
  {
    try {
      $user = Auth::user();

      if ($user->isAdmin()) {
        $requests = Loan::with(['user', 'item'])->get();
      } else {
        $requests = $user->loans()->with('item')->get();
      }
      return view('content.request.request-basic', compact('requests'));
    } catch (\Throwable $th) {
      return view('content.request.request-basic')->with('error', 'Tidak dapat memuat data');
    }
  }

  public function approve($id, Request $request)
  {
    try {
      $loan = Loan::find($id);

      if ($request) {
        $loan->status = "approved";
        $loan->desc = $request->desc;
      } else {
        $loan->status = "approved";
      }
      $loan->save();

      Cache::put('waiting_loans_count', Loan::where('status', 'waiting')->count());

      return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Tidak dapat menerima permintaan');
    }
  }

  public function reject($id, Request $request)
  {
    try {
      $loan = Loan::find($id);

      if ($request) {
        $loan->status = "rejected";
        $loan->desc = $request->desc;
      } else {
        $loan->status = "rejected";
      }
      $loan->save();

      Cache::put('waiting_loans_count', Loan::where('status', 'waiting')->count());

      return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Tidak dapat menerima permintaan');
    }
  }

  public function done($id)
  {
    try {
      $loan = Loan::find($id);
      $loan->status = "done";
      $loan->save();

      return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Tidak dapat mengubah status');
    }
  }

  public function delete($id)
  {
    try {
      $loan = Loan::find($id);
      $loan->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus.');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Tejadi kesalahan saat menghapus data');
    }
  }

  public function newUser(Request $request)
  {
    try {
      $user = new User();

      if ($user::where('nrp', $request->nrp)->exist()) {
        return redirect()->back()->with('error', 'Nomor telah terdaftar');
      } else {
        $user->name = $request->username;
        $user->email = $request->email;
        $user->nrp = $request->nomorInduk;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();

        $loan = new Loan();
        $loan->user_id = $user->nrp;
        $loan->item_id = $request->code;
        $loan->status = 'approved';
        $loan->loan_date = $request->loan_date;
        $loan->return_date = $request->return_date;
        $loan->save();

        return redirect()->back()->with('success', 'User and loan created successfully.');
      }
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Terjadi kesalahan');
    }
  }

  public function user(Request $request)
  {
    try {
      $input = $request->input('nrp');

      $nrp = (int)Str::before($input, ' ');

      $loan = new Loan();
      $loan->user_id = $nrp;
      $loan->item_id = $request->code;
      $loan->status = 'approved';
      $loan->loan_date = $request->loan_date;
      $loan->return_date = $request->return_date;

      $loan->save();

      return redirect()->back()->with('success', 'Record berhasil ditambahkan');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Terjadi Kesalahan');
    }
  }
}
