<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LabResult;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\VitalStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PosyanduApiController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->all();

        // Validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'nik' => 'nullable|string|max:20',
            'place_of_birth' => 'nullable|string|max:255',
            'birthdate' => 'nullable|date',
            'dukuh' => 'required|string|max:255',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'age_group' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'abdominal_circumference' => 'nullable|numeric',
            'arm_circumference' => 'nullable|numeric',
            'head_circumference' => 'nullable|numeric',
            'cholesterol' => 'nullable|numeric',
            'hemoglobin' => 'nullable|numeric',
            'gda' => 'nullable|numeric',
            'ua' => 'nullable|string|max:255',
            'complaints' => 'nullable|string|max:255',
            'diagnosis' => 'nullable|string|max:255',
            'medication' => 'nullable|string|max:255',
            'diseases' => 'nullable|string|max:255',
        ];

        // Validate the request data
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // Create new patient if not exists
        $patient = Patient::firstOrCreate([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'nik' => $data['nik'],
            'birthdate' => $data['birthdate'],
            'place_of_birth' => $data['place_of_birth'],
            'rt' => $data['rt'],
            'rw' => $data['rw'],
            'dukuh' => $data['dukuh'],
            'age_group' => $data['age_group'],
        ]);

        // Create new medical record
        $medicalRecord = MedicalRecord::create([
            'patient_id' => $patient->id,
            'complaints' => $data['complaints'],
            'diagnosis' => $data['diagnosis'],
            'medication' => $data['medication'],
            'diseases' => $data['diseases'],
            'family_planning' => $data['family_planning'] ?? 0,
        ]);

        // Create new vital statistics
        VitalStatistic::create([
            'medical_record_id' => $medicalRecord->id,
            'weight' => $data['weight'],
            'height' => $data['height'],
            'abdominal_circumference' => $data['abdominal_circumference'],
            'arm_circumference' => $data['arm_circumference'],
            'head_circumference' => $data['head_circumference'],
        ]);

        if ($data['cholesterol'] && $data['hemoglobin'] && $data['gda'] && $data['ua']) {
            LabResult::create([
                'medical_record_id' => $medicalRecord->id,
                'cholesterol' => $data['cholesterol'],
                'hemoglobin' => $data['hemoglobin'],
                'gda' => $data['gda'],
                'ua' => $data['ua'],
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Data saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request) {
        $medicalRecordId = $request->input('medical_record_id');
        if (!$medicalRecordId) {
            return response()->json(['success' => false, 'message' => 'Medical record ID is required'], 422);
        } else {
            $medicalRecord = MedicalRecord::find($medicalRecordId);
            if (!$medicalRecord) {
                return response()->json(['success' => false, 'message' => 'Medical record not found'], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
