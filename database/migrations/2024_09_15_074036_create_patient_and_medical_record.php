<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordSystemTables extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        //! ALL MARKED WITH TEXT SHOULD BE ENCRYPTED
        //! ALL MARKED WITH TEXT SHOULD BE ENCRYPTED
        //! ALL MARKED WITH TEXT SHOULD BE ENCRYPTED

        // Create Patients Table
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('rt');
            $table->string('rw');
            $table->string('dukuh');
            $table->timestamps();
        });

        // Create Medical Records Table
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade'); // Foreign key to patients table
            $table->text('complaints')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('medication')->nullable();
            $table->text('diseases')->nullable();
            $table->boolean('family_planning')->nullable();
            $table->timestamps();
        });

        // Create Vital Statistics Table
        Schema::create('vital_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade'); // Foreign key to medical records table
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->text('abdominal_circumference', 5, 2)->nullable();
            $table->text('arm_circumference', 5, 2)->nullable();
            $table->text('head_circumference', 5, 2)->nullable();
            $table->timestamps();
        });

        // Create Lab Results Table
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade'); // Foreign key to medical records table
            $table->text('cholesterol', 5, 2)->nullable();
            $table->text('hemoglobin', 5, 2)->nullable();
            $table->text('gda', 5, 2)->nullable(); // GDA (Gula Darah / Blood Glucose)
            $table->text('ua')->nullable(); // Urinalysis
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        // Drop tables in reverse order to avoid foreign key constraint issues
        Schema::dropIfExists('lab_results');
        Schema::dropIfExists('vital_statistics');
        Schema::dropIfExists('medical_records');
        Schema::dropIfExists('patients');
    }
}
