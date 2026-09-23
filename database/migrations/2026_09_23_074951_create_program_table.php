<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('kode_program', 20)->unique();
            $table->string('nama_program', 150);
            $table->text('deskripsi')->nullable();
            $table->enum('kategori', ['pendidikan', 'kesehatan', 'ekonomi', 'dakwah', 'sosial', 'kemanusiaan']);
            $table->enum('jenis', ['penghimpunan', 'penyaluran']);
            $table->decimal('target_dana', 15, 2)->default(0);
            $table->decimal('dana_terkumpul', 15, 2)->default(0);
            $table->decimal('dana_tersalurkan', 15, 2)->default(0);
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->enum('status', ['draft', 'aktif', 'selesai', 'ditutup'])->default('draft');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};