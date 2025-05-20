<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('academics', function (Blueprint $table) {
            $table->string('stream')->nullable()->after('academics');
        });
    }

    public function down()
    {
        Schema::table('academics', function (Blueprint $table) {
            $table->dropColumn('stream');
        });
    }
};
