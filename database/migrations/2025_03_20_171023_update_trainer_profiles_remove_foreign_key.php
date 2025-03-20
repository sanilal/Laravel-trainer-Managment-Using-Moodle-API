<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['user_id']);
            // Change the user_id column to remove foreign key constraints
            $table->unsignedBigInteger('user_id')->change();
        });
    }

    public function down()
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            // Restore the foreign key constraint if you rollback
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
