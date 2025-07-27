<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->string('patient_name')->nullable()->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->dropColumn('patient_name');
        });
    }
};
