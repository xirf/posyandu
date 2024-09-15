<?php

namespace Database\Factories;

use App\Models\LabResult;
use Illuminate\Database\Eloquent\Factories\Factory;

class LabResultFactory extends Factory {
    protected $model = LabResult::class;

    public function definition() {
        return [
            'medical_record_id' => \App\Models\MedicalRecord::factory(),
            'cholesterol' => $this->faker->randomFloat(2, 100, 300),
            'hemoglobin' => $this->faker->randomFloat(2, 10, 20),
            'gda' => $this->faker->randomFloat(2, 70, 150),
            'ua' => $this->faker->sentence,
        ];
    }
}