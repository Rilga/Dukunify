<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dukuns', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dukun')->unique();
            $table->string('nama_dukun');
            $table->text('description')->nullable();
            $table->decimal('harga', 10, 2)->default(0);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dukuns');
    }
};