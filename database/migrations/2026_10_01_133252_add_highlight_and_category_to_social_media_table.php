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
            if (!Schema::hasColumn('social_media', 'platform')) {
                $table->string('platform')->after('title')->default('Instagram'); // YouTube, TikTok, Instagram
            }
            if (!Schema::hasColumn('social_media', 'is_highlight')) {
                $table->boolean('is_highlight')->default(false)->after('url'); // Status centang highlight
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
