<?php

namespace App\Models;

use App\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordModel extends Model
{
    use HasFactory, Encryptable;

    protected $fillable = [
        'patient_id',
        'weight',
        'height',
        'arm_circumference',
        'head_circumference',
        'abdominal_circumference',
        'family_planning',
        'hypertension',
        'diabetes',
        'complaints',
        'therapy',
    ];

    // Encrypt only sensitive fields
    protected $encryptable = [
        'complaints',
        'therapy',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientModel::class);
    }
}
