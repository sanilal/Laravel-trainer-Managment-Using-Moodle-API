<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name_of_the_organization');
            $table->string('designation');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('upload_work_document')->nullable();
            $table->text('job_description');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('profile_id')->references('id')->on('trainer_profiles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_experiences');
    }
};
