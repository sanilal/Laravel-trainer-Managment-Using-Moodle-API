<?php

// database/migrations/xxxx_xx_xx_create_training_programs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('user_id');
            $table->string('program_name');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->text('details')->nullable(); // New field for details
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('trainer_profiles')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('trainer_profiles')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('training_programs');
    }
};
