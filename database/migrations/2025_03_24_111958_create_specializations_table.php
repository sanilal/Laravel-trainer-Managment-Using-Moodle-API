<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('trainer_profiles')->onDelete('cascade'); 
            $table->unsignedBigInteger('user_id');  
            $table->foreign('user_id')->references('user_id')->on('trainer_profiles')->onDelete('cascade'); 

            $table->string('specialization'); // Dropdown options (e.g., IT, Business, etc.)
            $table->string('name_of_the_institution');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('upload_certificate')->nullable(); // File path for the uploaded certificate

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specializations');
    }
};
