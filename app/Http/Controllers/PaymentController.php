<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {
        // Konfigurasi Midtrans [Sumber: Midtrans Docs]
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $kos = Kos::find($request->kos_id); // Mengambil data kos

        // Data transaksi untuk dikirim ke Midtrans [Sumber: Midtrans Docs]
        $params = [
            'transaction_details' => [
                'order_id' => 'TRX-' . uniqid(),
                'gross_amount' => (int) $kos->harga_per_bulan,
            ],
            'customer_details' => [
                'first_name' => $request->nama_penyewa,
                'email' => $request->email,
            ],
        ];

        // Mendapatkan token pembayaran [Sumber: Midtrans Docs]
        $snapToken = Snap::getSnapToken($params);
        return response()->json(['token' => $snapToken]);
    }
}
