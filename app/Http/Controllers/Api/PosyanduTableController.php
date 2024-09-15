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
        $age_group = $request->input('age_group');

        $medicalRecord = MedicalRecord::query()
        ->with(['patient', 'vitalStatistics', 'labResults']);

        if ($age_group) {
            $medicalRecord->whereHas('patient', function ($query) use ($age_group) {
                $query->where('age_group', $age_group);
            });
        }

        return response()->json([
            $medicalRecord->paginate(3),
        ]);
        
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
