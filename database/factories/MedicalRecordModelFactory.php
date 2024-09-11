<?php
namespace Database\Factories;

use App\Models\MedicalRecordModel;
use App\Models\PatientModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordModelFactory extends Factory
{
    protected $model = MedicalRecordModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' => PatientModel::factory(),
            'height' => $this->faker->numberBetween(50, 200),
            'weight' => $this->faker->numberBetween(3, 150),
            'arm_circumference' => $this->faker->numberBetween(10, 50),
            'head_circumference' => $this->faker->numberBetween(30, 60),
            'abd_circumference' => $this->faker->numberBetween(20, 100),
            'family_planning' => $this->faker->boolean,
            'hypertension' => $this->faker->boolean,
            'diabetes' => $this->faker->boolean,
            'complaints' => $this->faker->paragraph,
            'therapy' => $this->faker->paragraph,
            'age_category' => $this->faker->randomElement(['infant', 'child', 'teenager', 'adult', 'elderly']),
            'complaint' => $this->faker->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}