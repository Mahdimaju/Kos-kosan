<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('order_id')->unique(); // ID unik buat transaksi Midtrans
        $table->foreignId('kos_id')->constrained('kos')->onDelete('cascade'); // Relasi ke tabel kos
        $table->string('nama_penyewa');
        $table->bigInteger('jumlah_pembayaran');
        $table->dateTime('tanggal_pembayaran');
        $table->string('status')->default('Pending'); // Status awal: Pending, Lunas, atau Gagal
        $table->string('snap_token')->nullable(); // Tempat simpan token dari Midtrans
        $table->timestamps();
    });
}

    /**
     * Run the migrations.
     */

};
