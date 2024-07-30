<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log; // Pastikan ini diimport
use App\Http\Controllers\Controller;

class TelegramController extends Controller
{
  private $telegram_api_url;
  private $telegram_token;

  public function __construct()
  {
    $this->telegram_token = env('TELEGRAM_BOT_TOKEN');
    $this->telegram_api_url = "https://api.telegram.org/bot{$this->telegram_token}/sendMessage";

    // Log URL API untuk debugging
    Log::info('Telegram API URL: ' . $this->telegram_api_url);
  }

  public function sendMessage(Request $request)
  {
    $chat_id = '7062085565'; // Ganti dengan Chat ID yang benar
    $message = $request->input('basicFullname');

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

      if ($response->getStatusCode() == 200) {
        // return redirect()->back()->with('success', 'Message sent successfully');
      } else {
        // return redirect()->back()->with('error', 'Failed to send message');
      }
    } catch (\Exception $e) {
      return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
  }
}
