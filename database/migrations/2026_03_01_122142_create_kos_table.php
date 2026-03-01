<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('kos', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kos'); // Pastikan tertulis nama_kos
        $table->text('alamat');
        $table->integer('harga_per_bulan');
        $table->enum('status', ['Tersedia', 'Penuh'])->default('Tersedia');
        $table->string('image')->nullable()->after('fasilitas'); 
        $table->text('fasilitas')->nullable();
        $table->timestamps();
        
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
