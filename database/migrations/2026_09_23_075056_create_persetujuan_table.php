<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('persetujuan', function (Blueprint $table) {
            $table->id();
            $table->enum('referensi_tipe', ['penyaluran', 'penerimaan', 'program']);
            $table->unsignedBigInteger('referensi_id');
            $table->foreignId('approver_id')->nullable()->constrained('users');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->index(['referensi_tipe', 'referensi_id']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('persetujuan');
    }
};