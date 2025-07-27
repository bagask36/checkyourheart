<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->integer('age');
            $table->boolean('sex'); // 1: Male, 0: Female
            $table->integer('cp'); // Chest Pain Type
            $table->integer('trestbps'); // Resting Blood Pressure
            $table->integer('chol'); // Cholesterol
            $table->boolean('fbs'); // Fasting Blood Sugar
            $table->integer('restecg'); // Resting ECG Results
            $table->integer('thalach'); // Maximum Heart Rate Achieved
            $table->boolean('exang'); // Exercise Induced Angina
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examinations');
    }
};
