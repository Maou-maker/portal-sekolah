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
        Schema::table('social_media', function (Blueprint $table) {
            if (!Schema::hasColumn('social_media', 'title')) {
                $table->string('title')->after('id')->nullable();
            }
            if (!Schema::hasColumn('social_media', 'category')) {
                $table->string('category')->after('title')->default('Instagram'); // YouTube, TikTok, Instagram
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_media', function (Blueprint $table) {
            //
        });
    }
};
