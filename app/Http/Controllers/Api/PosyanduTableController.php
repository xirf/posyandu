<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class PosyanduTableController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $ageGroup = $request->query('ageGroup');
        $perPage = $request->query('perPage');
    
        if ($ageGroup && !in_array($ageGroup, ['toddler', 'infant', 'child', 'teenager', 'adult', 'elderly', 'all'])) {
            return response()->json([
                'message' => 'Invalid age group',
            ], 400);
        }
    
        $medicalRecordsQuery = MedicalRecord::with(['patient', 'vitalStatistics', 'labResults']);
    
        if ($ageGroup && $ageGroup !== 'all') {
            $medicalRecordsQuery->whereHas('patient', function ($query) use ($ageGroup) {
                $query->where('age_group', $ageGroup);
            });
        }
    
        $medicalRecords = $medicalRecordsQuery
            ->orderBy('created_at', 'desc')
            ->paginate($perPage ?? 50)
            ->appends(['ageGroup' => $ageGroup]);
    
        return response()->json($medicalRecords);
    }
    /**
     * Search for a specific resource.
     */

    public function search(Request $request) {
        $search = $request->query('search');
        $perPage = $request->query('perPage');

        $medicalRecords = MedicalRecord::with(['patient', 'vitalStatistics', 'labResults'])
            ->whereHas('patient', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage ?? 50);

        return response()->json($medicalRecords);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
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
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
