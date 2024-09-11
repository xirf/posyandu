<?php

namespace App\Models;

use App\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordModel extends Model
{
    use HasFactory, Encryptable;

    protected $table = 'medical_record';

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
        'age_category' // enum ['infant', 'child', 'teenager', 'adult', 'elderly']
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public const AGE = [
        'infant',
        'child',
        'teenager',
        'adult',
        'elderly'
    ];    


    // Encrypt only sensitive fields
    protected $encryptable = [
        'complaints',
        'therapy',
    ];

    public function patient()
    {
        return $this->belongsTo(PatientModel::class, 'patient_id');
    }
}
