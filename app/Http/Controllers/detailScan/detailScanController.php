<?php

namespace App\Http\Controllers\detailScan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class detailScanController extends Controller
{
    //
    public function index($decodedText)
    {
        // Lakukan sesuatu dengan $decodedText
        // Misal mengirim data sebagai contoh
        $data = [
            'frekuensi' => 50,
            'suhu' => 22,
            'nilai' => 75,
            'decodedText' => $decodedText
        ];

        return response()->json($data);
    }

    public function receiveData(Request $request)
    {
        // Validasi data jika diperlukan
        $validatedData = $request->validate([
            'decodedText' => 'required|string',
            'decodedResult' => 'required|array', // atau sesuai tipe data yang diharapkan
        ]);

        // Proses data yang diterima
        $decodedText = $validatedData['decodedText'];
        $decodedResult = $validatedData['decodedResult'];

        // Misalnya, simpan data ke database atau proses lainnya
        // ...

        // Kembalikan respons JSON
        return response()->json([
            'message' => 'Data received successfully',
            'data' => $decodedText,
        ]);
    }
}
