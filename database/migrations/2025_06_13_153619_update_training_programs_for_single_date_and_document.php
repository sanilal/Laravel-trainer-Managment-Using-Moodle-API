<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  // database/migrations/xxxx_xx_xx_update_training_programs_for_single_date_and_document.php
public function up()
{
    Schema::table('training_programs', function (Blueprint $table) {
        $table->date('training_date')->nullable()->after('program_name'); // <- make it nullable first
        $table->string('document')->nullable()->after('details');

        $table->dropColumn(['start_date', 'end_date']);
    });
}

public function down()
{
    Schema::table('training_programs', function (Blueprint $table) {
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->dropColumn(['training_date', 'document']);
    });
}

};
