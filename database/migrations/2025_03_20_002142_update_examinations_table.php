<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExaminationsTable extends Migration
{
    /**
     * Jalankan perubahan ke database.
     */
    public function up()
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->integer('prediction')->after('exang')->comment('0 = Tidak Berisiko, 1 = Berisiko');
            $table->json('shap_values')->nullable()->after('prediction')->comment('Nilai SHAP dalam bentuk JSON');
            $table->text('explanation')->nullable()->after('shap_values')->comment('Penjelasan risiko penyakit jantung berdasarkan SHAP');
        });
    }

    /**
     * Rollback perubahan.
     */
    public function down()
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->dropColumn(['prediction', 'shap_values', 'explanation']);
        });
    }
}