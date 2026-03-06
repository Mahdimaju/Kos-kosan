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
        try {
            // 1. Ambil data kos berdasarkan ID
            $kos = Kos::findOrFail($request->kos_id);

            // 2. Buat ID Order unik
            $orderId = 'TRX-' . time() . '-' . $kos->id;

            // 3. Simpan transaksi ke database secara OTOMATIS
            // Pastikan kolom ini sudah ada di migration kamu
            $transaksi = Transaksi::create([
                'order_id'           => $orderId,
                'kos_id'             => $kos->id,
                'nama_penyewa'       => $request->nama_penyewa ?? 'Penyewa Otomatis',
                'jumlah_pembayaran'  => (int) $kos->harga_per_bulan,
                'tanggal_pembayaran' => now(),
                'status'             => 'Pending', // Status awal
            ]);

            // 4. Konfigurasi Midtrans [Sumber: Midtrans Docs]
            Config::$serverKey    = config('services.midtrans.serverKey');
            Config::$isProduction = false;
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            // 5. Parameter untuk Midtrans [Sumber: Midtrans Docs]
            $params = [
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => (int) $transaksi->jumlah_pembayaran,
                ],
                'customer_details' => [
                    'first_name' => $transaksi->nama_penyewa,
                    'email'      => $request->email ?? 'customer@example.com',
                ],
            ];

            // 6. Dapatkan Snap Token [Sumber: Midtrans Docs]
            $snapToken = Snap::getSnapToken($params);

            // Simpan token ke database untuk referensi
            $transaksi->update(['snap_token' => $snapToken]);

            return response()->json(['token' => $snapToken]);

        } catch (\Exception $e) {
            // Kirim pesan error jika gagal agar bisa dicek di console browser
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.serverKey');
        
        // Verifikasi keamanan signature [Sumber: Midtrans Docs]
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            // Jika pembayaran berhasil (Settlement) atau terverifikasi (Capture) [Sumber: Midtrans Docs]
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                // Update status di database MariaDB Termux menjadi "Lunas"
                Transaksi::where('order_id', $request->order_id)->update([
                    'status' => 'Lunas'
                ]);
            } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
                // Update status jika waktu bayar habis
                Transaksi::where('order_id', $request->order_id)->update([
                    'status' => 'Gagal'
                ]);
            }
        }
    }
}
