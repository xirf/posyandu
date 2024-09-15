<?php

namespace App\Models;

use App\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model {
    use HasFactory, Encryptable;

    protected $table = 'patients';

    protected $fillable = [
        'name',
        'nik',
        'birthdate',
        'lace_of_birth',
        'gender',
        'rt',
        'rw',
        'dukuh',
    ];

    // Only encrypt sensitive fields
    protected $encryptable = [
        'nik',
        'rt',
        'rw',
        'dukuh',
        'birth_date',
        'place_of_birth',
        'address',
    ];

    public function medicalRecords() {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }
}
