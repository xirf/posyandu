<?php

namespace Database\Factories;

use App\Models\VitalStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class VitalStatisticFactory extends Factory {
    protected $model = VitalStatistic::class;

    public function definition() {
        return [
            'medical_record_id' => \App\Models\MedicalRecord::factory(),
            'weight' => $this->faker->randomFloat(2, 30, 100),
            'height' => $this->faker->randomFloat(2, 100, 200),
            'abdominal_circumference' => $this->faker->randomFloat(2, 20, 100),
            'arm_circumference' => $this->faker->randomFloat(2, 10, 50),
            'head_circumference' => $this->faker->randomFloat(2, 30, 60),
        ];
    }
}