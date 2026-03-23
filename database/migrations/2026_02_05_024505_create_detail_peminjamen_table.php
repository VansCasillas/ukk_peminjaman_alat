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
        Schema::create('detail_peminjamen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('peminjaman_alat_id')->constrained('peminjaman_alats')->onDelete('cascade');
            $table->enum('status', ['dipinjam', 'dikembalikan'])->nullable();
            $table->enum('persetujuan', ['disetujui', 'ditolak'])->nullable();
            $table->string('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjamen');
    }
};
