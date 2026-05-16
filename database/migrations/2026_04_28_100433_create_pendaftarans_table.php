<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();

            // =====================
            // DATA SISWA
            // =====================
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->string('nik')->nullable();

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->enum('jenis_kelamin', ['L', 'P']);

            $table->text('alamat');

            $table->string('no_hp')->unique();
            $table->string('email')->unique();

            $table->string('asal_sekolah');

            // =====================
            // RELASI PROGRAM
            // =====================
            $table->foreignId('program_unggulan_id')
                ->constrained('program_unggulans')
                ->onDelete('cascade');

            // =====================
            // ORANG TUA
            // =====================
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('no_hp_wali')->nullable();

            // =====================
            // FILE UPLOAD
            // =====================
            $table->string('foto_siswa')->nullable();
            $table->string('file_kk')->nullable();
            $table->string('transkrip_nilai')->nullable();

            // =====================
            // STATUS PPDB
            // =====================
            $table->enum('status', [
                'pending',
                'dibaca',
                'diverifikasi',
                'lolos_berkas',
                'diterima',
                'ditolak'
            ])->default('pending');

            $table->text('catatan_admin')->nullable();

            // =====================
            // 🔥 TRACKING ADMIN (INI YANG BARU)
            // =====================
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();

            $table->timestamps();

            $table->index('nisn');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};