<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\VitalStatistic;
use App\Models\LabResult;

class MedicalRecordSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // Create Patients
        Patient::factory(500)->create()->each(function ($patient) {
            // Create Medical Records for each Patient
            MedicalRecord::factory(2)->create(['patient_id' => $patient->id])->each(function ($medicalRecord) {
                // Create Vital Statistics for each Medical Record
                VitalStatistic::factory(1)->create(['medical_record_id' => $medicalRecord->id]);
                // Create Lab Results for each Medical Record
                LabResult::factory(1)->create(['medical_record_id' => $medicalRecord->id]);
            });
        });
    }
}