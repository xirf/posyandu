<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory {
    protected $model = Patient::class;

    public function definition() {
        return [
            'name' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('##########'),
            'birthdate' => $this->faker->date,
            'place_of_birth' => $this->faker->city,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'rt' => $this->faker->numerify('##'),
            'rw' => $this->faker->numerify('##'),
            'dukuh' => $this->faker->word,
            'age_group' => $this->faker->randomElement(['infant', 'child', 'teenager', 'adult', 'elderly']),
        ];
    }
}