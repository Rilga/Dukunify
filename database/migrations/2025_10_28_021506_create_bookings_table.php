<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('dukun_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_mulai_sewa');
            $table->date('tanggal_selesai_sewa');
            $table->dateTime('tanggal_pengajuan_pengembalian')->nullable();
            $table->date('tanggal_pengembalian')->nullable();
            $table->decimal('total_harga', 10, 2);
            $table->decimal('denda', 10, 2)->default(0);
            $table->enum('status', ['aktif', 'pending_completion', 'selesai', 'menunggu_pembayaran_denda'])->default('aktif');

            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('bookings');
    }
};