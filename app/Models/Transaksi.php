<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import class relasi [Sumber: Laravel Docs]

class Transaksi extends Model
{
    protected $fillable = [
        'kos_id', 
        'nama_penyewa', 
        'jumlah_pembayaran', 
        'tanggal_pembayaran', 
        'status'
    ];

    /**
     * Mendefinisikan relasi bahwa setiap Transaksi dimiliki oleh satu Kos.
     * Metode ini akan menyelesaikan error RelationshipJoiner Anda.
     */
    public function kos(): BelongsTo
    {
        return $this->belongsTo(Kos::class); // Menghubungkan model Transaksi ke model Kos [Sumber: Eloquent Relations]
    }
}
