<?php

namespace Database\Factories;

use App\Models\PatientModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatientModelFactory extends Factory {
    protected $model = PatientModel::class;

    public function definition() {
        return [
            'name' => $this->faker->name,
            'birth_date' => $this->faker->date('Y-m-d'),
            'place_of_birth' => $this->faker->city,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
