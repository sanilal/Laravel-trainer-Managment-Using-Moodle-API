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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moodle_user_id')->unique(); // Link to Moodle user
            $table->string('specialization')->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainers');
    }
};
