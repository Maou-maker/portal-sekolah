<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge')->nullable();       // Contoh: Profil Madrasah
            $table->string('title');                   // Judul konten
            $table->text('content');                   // Isi deskripsi
            $table->string('image')->nullable();       // Foto
            $table->enum('position', ['left', 'right'])->default('left'); // Posisi gambar: kiri atau kanan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
