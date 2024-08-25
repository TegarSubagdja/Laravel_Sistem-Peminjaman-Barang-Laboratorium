<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Analytics extends Controller
{
  public function index()
  {
    // Jumlah Pengajuan yang menunggu persetujuan (misalnya status 'waiting')
    $jumlahPengajuan = Loan::where('status', 'waiting')->count();

    // Jumlah Peminjam yang sedang meminjam (misalnya status 'approved' atau 'approved')
    $jumlahPeminjam = Loan::where('status', 'approved')->count();

    // Jumlah yang perlu dikembalikan (misalnya status 'approved' dan tanggal kembali <= hari ini)
    $jumlahPerluDikembalikan = Loan::where('status', 'approved')
      ->whereDate('return_date', '<=', Carbon::today())
      ->count();

    // Jumlah Peminjaman yang melebihi batas (misalnya status 'approved' dan tanggal kembali < hari ini)
    $jumlahMelebihiBatas = Loan::where('status', 'approved')
      ->whereDate('return_date', '<', Carbon::today())
      ->count();

    return view('content.dashboard.dashboards-analytics', compact('jumlahPengajuan', 'jumlahPeminjam', 'jumlahPerluDikembalikan', 'jumlahMelebihiBatas'));
  }
}
