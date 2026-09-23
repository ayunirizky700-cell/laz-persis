<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerimaan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_transaksi', 30)->unique();
            $table->date('tanggal');
            $table->foreignId('muzakki_id')->nullable()->constrained('muzakki');
            $table->string('nama_donatur', 100)->nullable();
            $table->foreignId('program_id')->nullable()->constrained('program');
            $table->enum('jenis_dana', ['zakat', 'infaq', 'sedekah', 'wakaf', 'dana_kemanusiaan', 'csr']);
            $table->decimal('nominal', 15, 2);
            $table->enum('metode_pembayaran', ['tunai', 'transfer_bank', 'qris', 'e_wallet', 'lainnya']);
            $table->string('no_referensi', 50)->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'valid', 'ditolak', 'dibatalkan'])->default('pending');
            $table->foreignId('validated_by')->nullable()->constrained('users');
            $table->timestamp('validated_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('penerimaan');
    }
};