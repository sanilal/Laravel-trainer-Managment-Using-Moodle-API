<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trainer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Links to users table
            $table->string('prefix')->nullable();
            $table->string('prefix2')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('family_name');
            $table->date('date_of_birth')->nullable();
            $table->string('country')->nullable();
            $table->string('residency_status')->nullable();
            $table->string('residing_city')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('photo')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('others')->nullable();
            $table->text('about_you')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainer_profiles');
    }
};
