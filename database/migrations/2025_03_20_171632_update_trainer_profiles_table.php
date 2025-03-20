<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            // Rename columns if they exist
            if (Schema::hasColumn('trainer_profiles', 'photo')) {
                $table->renameColumn('photo', 'profile_image');
            }
            if (Schema::hasColumn('trainer_profiles', 'others')) {
                $table->renameColumn('others', 'other_socialmedia');
            }

            // Add missing columns ONLY if they don’t exist
            foreach (['facebook', 'instagram', 'youtube', 'twitter', 'other_socialmedia'] as $column) {
                if (!Schema::hasColumn('trainer_profiles', $column)) {
                    $table->string($column)->nullable()->after('website');
                }
            }
        });
    }

    public function down()
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            // Rollback changes
            if (Schema::hasColumn('trainer_profiles', 'profile_image')) {
                $table->renameColumn('profile_image', 'photo');
            }
            if (Schema::hasColumn('trainer_profiles', 'other_socialmedia')) {
                $table->renameColumn('other_socialmedia', 'others');
            }

            // Drop only if the columns exist
            foreach (['facebook', 'instagram', 'youtube', 'twitter', 'other_socialmedia'] as $column) {
                if (Schema::hasColumn('trainer_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
