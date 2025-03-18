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
        Schema::table('trainer_profiles', function (Blueprint $table) {
            // Rename fields
            $table->renameColumn('photo', 'profile_image');
            $table->renameColumn('others', 'other_socialmedia');

            // Add new social media fields if not already present
            $table->string('facebook')->nullable()->after('website');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('youtube')->nullable()->after('instagram');
            $table->string('twitter')->nullable()->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            // Rollback changes
            $table->renameColumn('profile_image', 'photo');
            $table->renameColumn('other_socialmedia', 'others');

            // Drop the new fields
            $table->dropColumn(['facebook', 'instagram', 'youtube', 'twitter']);
        });
    }
};
