<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('no_telepon');
            $table->string('topik_pertanyaan');
            $table->text('pesan');
            $table->enum('status', ['pending', 'dibaca', 'dibalas'])->default('pending');
            $table->text('balasan_admin')->nullable();
            $table->timestamp('dibaca_pada')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};