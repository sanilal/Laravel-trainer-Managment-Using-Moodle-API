<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::dropIfExists('trainers');
}

public function down()
{
    Schema::create('trainers', function (Blueprint $table) {
        $table->id();
        $table->string('user_name');
        $table->timestamps();
    });
}
};
