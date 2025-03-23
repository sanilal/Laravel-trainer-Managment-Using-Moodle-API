<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('personal_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('trainer_profiles')->onDelete('cascade'); 
            $table->unsignedBigInteger('user_id'); // No direct constraint to users
            // Instead of foreignId(), use a manual constraint
            $table->foreign('user_id')->references('user_id')->on('trainer_profiles')->onDelete('cascade'); 
            $table->string('your_id')->nullable();
            $table->string('your_passport')->nullable();
            $table->string('other_document')->nullable();
            $table->string('other_document2')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_documents');
    }
};
