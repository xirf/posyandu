<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientModel;
use Illuminate\Http\Request;

class PatientApiController extends Controller {
    /**
     * Search patients by name, address, or other criteria.
     */
    public function search(Request $request) {
        $query = PatientModel::query();

        if ($request->has('name')) {
            $name = strtolower($request->input('name'));
            $query->whereRaw('LOWER(name) LIKE ?', ["%$name%"]);
        }

        $patients = $query->take(20)->get();

        // wait for 1 second to simulate a slow API
        sleep(1000);
        return response()->json($patients);
    }

    public function index() {
        $patients = PatientModel::take(20)->get();

        return response()->json($patients);
    }

    /**
     * Retrieve patient by ID
     */
    public function show($id) {
        $patient = PatientModel::findOrFail($id);

        return response()->json($patient);
    }
}
