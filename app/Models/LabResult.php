<?php
// app/Models/LabResult.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model {
    use HasFactory;

    protected $table = 'lab_results';

    protected $fillable = [
        'medical_record_id',
        'cholesterol',
        'hemoglobin',
        'gda',
        'ua',
    ];

    protected $encryptable = [
        'cholesterol',
        'hemoglobin',
        'gda',
        'ua',
    ];

    public function medicalRecord() {
        return $this->belongsTo(MedicalRecord::class);
    }
}
