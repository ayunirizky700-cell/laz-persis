<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('amil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nip_amil', 30)->nullable()->unique();
            $table->string('jabatan', 50);
            $table->string('divisi', 50)->nullable();
            $table->string('cabang', 50)->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'cuti'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('amil');
    }
};