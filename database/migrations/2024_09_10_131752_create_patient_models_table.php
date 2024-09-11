<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('nik')->optional();
            $table->text('birth_date')->optional();
            $table->text('place_of_birth')->optional();
            $table->text('gender')->optional();
            $table->text('address')->optional();
            $table->timestamps();
        });

        Schema::create('medical_record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patient');
            $table->integer('height')->optional();
            $table->integer('weight')->optional();
            $table->integer('arm_circumference')->optional();
            $table->integer('head_circumference')->optional();
            $table->integer('abd_circumference')->optional();
            $table->boolean('family_planning')->optional();
            $table->boolean('hypertension')->optional();
            $table->boolean('diabetes')->optional();
            $table->text('complaints')->optional();
            $table->text('therapy')->optional();
            $table->enum('age_category', ['infant', 'child', 'teenager', 'adult', 'elderly'])->optional();
            $table->string('complaint')->optional();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('patient');
        Schema::dropIfExists('medical_record');
    }
};
