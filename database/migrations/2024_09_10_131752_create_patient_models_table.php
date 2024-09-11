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
            $table->string('name');
            $table->date('birth_date');
            $table->string('place_of_birth');
            $table->string('gender');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('medical_record', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patient');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('arm_circumference');
            $table->integer('head_circumference');
            $table->integer('abd_circumference');
            $table->boolean('family_planning');
            $table->boolean('hypertension');
            $table->boolean('diabetes');
            $table->text('complaints');
            $table->text('therapy');
            $table->enum('age_category', ['infant', 'child', 'teenager', 'adult', 'elderly']);
            $table->string('complaint');
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
