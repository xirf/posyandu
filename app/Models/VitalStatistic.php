<?php

namespace App\Models;

use App\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalStatistic extends Model
{
    use HasFactory, Encryptable;

    protected $table = 'vital_statistics';

    protected $fillable = [
        'medical_record_id',
        'weight',
        'height',
        'abdominal_circumference',
        'arm_circumference',
        'head_circumference',
    ];

    protected $encryptable = [
        'abdominal_circumference',
        'arm_circumference',
        'head_circumference',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }
}
