<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip', 25)->nullable()->unique(); // NIP / NIY Guru
            $table->string('position'); // Jabatan (Contoh: Guru Matematika / Wali Kelas)
            $table->enum('gender', ['L', 'P']); // L = Laki-laki, P = Perempuan
            $table->text('address')->nullable();
            $table->string('photo')->nullable(); // Foto profil guru

            // TAMBAHAN INI: Kolom role untuk membedakan pimpinan dan guru biasa
            $table->enum('role', ['teacher', 'headmaster', 'foundation_head'])->default('teacher');
            // teacher = Guru Biasa, headmaster = Kepala Sekolah, foundation_head = Kepala Yayasan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_teachers');
    }
};