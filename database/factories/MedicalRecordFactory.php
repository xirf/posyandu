<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory {
    protected $model = MedicalRecord::class;

    // 2 year span from today and negative 2 year span from today
    private $dateRange = 730;

    public function definition() {
        $theDate = $this->faker->dateTimeBetween('-' . $this->dateRange . ' days', 'now');

        return [
            'patient_id' => \App\Models\Patient::factory(),
            'complaints' => $this->faker->sentence,
            'diagnosis' => $this->faker->sentence,
            'medication' => $this->faker->sentence,
            'diseases' => $this->faker->sentence,
            'family_planning' => $this->faker->boolean,
            'created_at' => $theDate,
            'updated_at' => $theDate
        ];
    }
}
