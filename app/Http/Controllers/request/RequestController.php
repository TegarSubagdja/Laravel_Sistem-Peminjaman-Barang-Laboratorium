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

class RequestController extends Controller
{
  //Index
  public function index()
  {
    return view('content.request.request-basic');
  }

  public function getRequest()
  {
    $user = Auth::user();

    if ($user->isAdmin()) {
      // Ambil semua loans dengan relasi user dan item
      $requests = Loan::with(['user', 'item'])->get();
    } else {
      // Ambil loans yang terkait dengan user yang sedang login
      $requests = $user->loans()->with('item')->get();
    }

    return view('content.request.request-basic', compact('requests'));
  }

  public function approve($id)
  {
    $loan = Loan::find($id);
    $loan->status = "approved";
    $loan->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
  }

  public function done($id)
  {
    $loan = Loan::find($id);
    $loan->status = "done";
    $loan->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
  }

  public function delete($id)
  {
    $loan = Loan::find($id);
    $loan->delete();

    return redirect()->route('request-basic')->with('success', 'Data berhasil dihapus.');
  }

  public function newUser(Request $request)
  {
    // Buat user baru
    $user = new User();
    $user->name = $request->username;
    $user->email = $request->email;
    $user->nrp = $request->nomorInduk;
    $user->role = $request->role;
    $user->password = Hash::make($request->password);
    $user->save();

    // Buat peminjaman baru dan kaitkan dengan user yang baru dibuat
    $loan = new Loan();
    $loan->user_id = $user->nrp;
    $loan->item_id = $request->code;
    $loan->loan_date = $request->loan_date;
    $loan->return_date = $request->return_date;
    // $loan->user()->associate($user);
    $loan->save();
    // $loan->save();

    // Redirect atau response sesuai kebutuhan
    return redirect()->back()->with('success', 'User and loan created successfully.');
  }

  public function user(Request $request)
  {
    $input = $request->input('nrp');

    $nrp = (int)Str::before($input, ' ');

    $loan = new Loan();
    $loan->user_id = $nrp;
    $loan->item_id = $request->code;
    $loan->loan_date = $request->loan_date;
    $loan->return_date = $request->return_date;

    $loan->save();

    return redirect()->back()->with('success', 'Record berhasil ditambahkan');
  }
}
