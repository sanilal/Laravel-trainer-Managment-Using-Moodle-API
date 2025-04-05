<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('academics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('trainer_profiles')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            
            // Remove the duplicate foreign key constraint
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('trainer_profiles')
                  ->onDelete('cascade');
            
            $table->enum('academics', ['diploma', 'bachelor degree', 'masters degree', 'doctoral degree']);
            $table->string('name_of_the_university');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('upload_certificate')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academics');
    }
};