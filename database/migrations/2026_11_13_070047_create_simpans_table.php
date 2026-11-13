<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simpanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id')
                  ->constrained('anggotas')
                  ->cascadeOnDelete();

            $table->date('tanggal');
            $table->string('jenis_simpanan');
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};