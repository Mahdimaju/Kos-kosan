<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void {
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        // Menghubungkan transaksi dengan data kos [Sumber: Laravel Migrations]
        $table->foreignId('kos_id')->constrained('kos')->onDelete('cascade');
        $table->string('nama_penyewa');
        $table->integer('jumlah_pembayaran');
        $table->date('tanggal_pembayaran');
        $table->enum('status', ['Pending', 'Lunas', 'Batal'])->default('Pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
