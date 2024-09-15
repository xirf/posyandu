<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // get all medical records  with patient information
        $medicalRecords = MedicalRecord::with('patient')
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('report.all', [
            'medicalRecords' => $medicalRecords
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('report.new');
    }

    public function getTable(Request $request) {
        $medicalRecords = MedicalRecord::with('patient')
            ->orderBy('created_at', 'desc')
            ->paginate(100);
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
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
