<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            $table->boolean('specialization_completed')->default(false)->after('about_you');
        });
    }

    public function down()
    {
        Schema::table('trainer_profiles', function (Blueprint $table) {
            $table->dropColumn('specialization_completed');
        });
    }
};
