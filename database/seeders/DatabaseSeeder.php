<?php

namespace Database\Seeders;

use App\Models\MedicalRecordModel;
use App\Models\PatientModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Administrator',
        //     'email' => 'admin@admin.com',
        //     'password' => bcrypt('password'),
        //     'picture' => 'https://i.pravatar.cc/150?img=1',
        //     'bio' => 'Administrator',
        // ]);

        PatientModel::factory()
            ->count(50)
            ->has(MedicalRecordModel::factory()->count(3), 'medicalRecords') // Corrected relationship method name
            ->create();
    }
}