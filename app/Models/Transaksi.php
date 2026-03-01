<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
 public function kos() { return $this->belongsTo(Kos::class); }
}
