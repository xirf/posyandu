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
        'gender',
        'nik',
        'birthdate',
        'place_of_birth',
        'rt',
        'rw',
        'dukuh',
        'age_group',
    ];
    
    protected $encryptable = [
        'nik',
        'birthdate',
        'place_of_birth',
        'rt',
        'rw',
        'dukuh',
    ];

    protected $casts = [
        'age_group' => 'string',
    ];

    public const AGE_GROUPS = [
        'infant' => 'infant',
        'child' => 'child',
        'teenager' => 'teenager',
        'adult' => 'adult',
        'elderly' => 'elderly',
    ];

    public function medicalRecords() {
        return $this->hasMany(MedicalRecord::class, 'patient_id');
    }
}
