<?php

namespace App\Models;

use App\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MedicalRecord extends Model {
    use HasFactory;

    protected $table = 'medical_records';

    protected $fillable = [
        'patient_id',
        'complaints',
        'diagnosis',
        'medication',
        'diseases',
        'family_planning',
    ];

    protected $encryptable = [
        'complaints',
        'diagnosis',
        'medication',
        'diseases',
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function vitalStatistics() {
        return $this->hasMany(VitalStatistic::class);
    }

    public function labResults() {
        return $this->hasMany(LabResult::class);
    }
}
