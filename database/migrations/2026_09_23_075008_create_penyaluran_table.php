<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penyaluran', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi', 30)->unique();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_realisasi')->nullable();
            $table->foreignId('program_id')->constrained('program');
            $table->foreignId('mustahik_id')->constrained('mustahik');
            $table->enum('jenis_bantuan', ['uang', 'barang', 'jasa', 'beasiswa', 'sembako']);
            $table->decimal('nominal', 15, 2);
            $table->text('deskripsi_bantuan')->nullable();
            $table->string('bukti_penyaluran')->nullable();
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak', 'direalisasi', 'dibatalkan'])->default('draft');
            $table->text('keterangan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('penyaluran');
    }
};