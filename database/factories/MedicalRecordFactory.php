<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory {
    protected $model = MedicalRecord::class;

    public function definition() {
        return [
            'patient_id' => \App\Models\Patient::factory(),
            'complaints' => $this->faker->sentence,
            'diagnosis' => $this->faker->sentence,
            'medication' => $this->faker->sentence,
            'diseases' => $this->faker->sentence,
            'family_planning' => $this->faker->boolean,
        ];
    }
}