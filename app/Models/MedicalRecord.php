<?php

namespace App\Models;

use App\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MedicalRecord extends Model {
    use HasFactory, Encryptable;

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
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function vitalStatistics() {
        return $this->hasOne(VitalStatistic::class, 'medical_record_id');
    }

    public function labResults() {
        return $this->hasOne(LabResult::class, 'medical_record_id');
    }
}

