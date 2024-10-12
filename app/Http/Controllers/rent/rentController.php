<?php

namespace App\Http\Controllers\rent;

use App\Models\Item;
use App\Models\Loan;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class rentController extends Controller
{
  //
  private $telegram_api_url;
  private $telegram_token;

  public function __construct()
  {
    $this->telegram_token = env('TELEGRAM_BOT_TOKEN');
    $this->telegram_api_url = "https://api.telegram.org/bot{$this->telegram_token}/sendMessage";
  }

  public function rent(Request $request)
  {
    try {
      DB::transaction(function () use ($request) {
        // Mengunci baris item untuk update
        $item = Item::where('code', $request->code)->lockForUpdate()->first();

        // Memeriksa apakah ada cukup barang yang tersedia
        if ($item->quantity - $item->reserved <= 0) {
          throw new \Exception('Barang tidak tersedia untuk dipinjam.');
        }

        // Mengupdate jumlah barang yang di-reserved
        $item->reserved += $request->quantity;
        $item->save();

        // Membuat record peminjaman baru
        $loan = Loan::create([
          'user_id' => Auth::user()->nrp,
          'item_id' => $request->code,
          'quantity' => $request->quantity,
          'loan_date' => $request->date,
          'return_date' => $request->due,
          'status' => 'waiting',
        ]);

        $this->sendMessage($loan);
      });

      return redirect()->back()->with('success', 'Permintaan berhasil dikirim');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', $th->getMessage());
    }
  }


  public function sendMessage($loan)
  {
    $chat_id = '7062085565'; // Ganti dengan Chat ID yang benar
    $message = "Permintaan Peminjalam:\n" .
      "ID User: " . $loan->user_id . "\n" .
      "Nama: " . $loan->user->name . "\n" .
      "ID Barang: " . $loan->item_id . "\n" .
      "Nama Barang: " . $loan->item->name . "\n" .
      "Tanggal Peminjaman: " . $loan->loan_date . "\n" .
      "Tanggal Pengembalian: " . $loan->return_date . "\n" .
      "Status: " . $loan->status;

    if (!$message) {
      return redirect()->back()->with('error', 'Message is required');
    }

    $client = new Client();
    try {
      $response = $client->post($this->telegram_api_url, [
        'json' => [
          'chat_id' => $chat_id,
          'text' => $message,
        ],
        'verify' => false, // Tambahkan baris ini untuk melewati verifikasi SSL
      ]);
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
  }
}
