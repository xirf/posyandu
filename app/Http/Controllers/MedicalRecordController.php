<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        // get all medical records  with patient information
        $medicalRecords = MedicalRecord::with('patient')
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        return view('posyandu.all', [
            'medicalRecords' => $medicalRecords
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('posyandu.new');
    }

    public function getTable(Request $request) {
        $medicalRecords = MedicalRecord::with('patient')
            ->orderBy('created_at', 'desc')
            ->paginate(100);
        return response()->json($medicalRecords);
    }


    public function export(string $year, string $month) {
        $cacheKey = "medical_records_excel_{$year}_{$month}";

        if (Cache::has($cacheKey)) {
            $filePath = Cache::get($cacheKey);
            return response()->download(storage_path("app/{$filePath}"));
        }

        $medicalRecords = MedicalRecord::with('patient', 'vitalStatistics', 'labResults')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $formattedRecords = $medicalRecords->map(function ($record) {
            return [
                'Nama Pasien' => $record->patient->name,
                'NIK' => optional($record->patient->nik),
                'Jenis Kelamin' => __($record->patient->gender),
                'Tanggal Lahir' => $record->patient->birthdate,
                'Tempat Lahir' => $record->patient->place_of_birth,
                'Desa' => $record->patient->dukuh,
                'RT' => $record->patient->rt,
                'RW' => $record->patient->rw,
                'Kelompok Umur' => __($record->patient->age_group),
                'Tinggi Badan' => optional($record->vitalStatistics)->height,
                'Berat Badan' => optional($record->vitalStatistics)->weight,
                'Lingkar Kepala' => optional($record->vitalStatistics)->head_circumference,
                'Lingkar Lengan Atas' => optional($record->vitalStatistics)->arm_circumference,
                'Lingkar Pinggul' => optional($record->vitalStatistics)->abdominal_circumference,
                'Kolesterol' => optional($record->labResults)->cholesterol,
                'Hemoglobin' => optional($record->labResults)->hemoglobin,
                'Gula Darah' => optional($record->labResults)->gda,
                'Urine' => optional($record->labResults)->ua,
                'KB' => optional($record->family_planning),
                'Keluhan' => optional($record->complaints),
                'Diagnosa' => optional($record->diagnosis),
                'Penyakit' => optional($record->diseases),
                'Obat' => optional($record->medication),
            ];
        });

        $filePath = "exports/medical-records_{$year}_{$month}.xlsx";
        (new FastExcel($formattedRecords))->export(storage_path("app/{$filePath}"));

        Cache::put($cacheKey, $filePath, now()->addHours(1));

        return response()->download(storage_path("app/{$filePath}"));
    }

    public function exportAll(string $year) {
        $cacheKey = "medical_records_excel_{$year}";

        if (Cache::has($cacheKey)) {
            $filePath = Cache::get($cacheKey);
            return response()->download(storage_path("app/{$filePath}"));
        }

        $medicalRecords = MedicalRecord::with('patient', 'vitalStatistics', 'labResults')
            ->whereYear('created_at', $year)
            ->get();

        $formattedRecords = $medicalRecords->map(function ($record) {
            return [
                'Nama Pasien' => $record->patient->name,
                'NIK' => optional($record->patient->nik),
                'Jenis Kelamin' => __($record->patient->gender),
                'Tanggal Lahir' => $record->patient->birthdate,
                'Tempat Lahir' => $record->patient->place_of_birth,
                'Desa' => $record->patient->dukuh,
                'RT' => $record->patient->rt,
                'RW' => $record->patient->rw,
                'Kelompok Umur' => __($record->patient->age_group),
                'Tinggi Badan' => optional($record->vitalStatistics)->height,
                'Berat Badan' => optional($record->vitalStatistics)->weight,
                'Lingkar Kepala' => optional($record->vitalStatistics)->head_circumference,
                'Lingkar Lengan Atas' => optional($record->vitalStatistics)->arm_circumference,
                'Lingkar Pinggul' => optional($record->vitalStatistics)->abdominal_circumference,
                'Kolesterol' => optional($record->labResults)->cholesterol,
                'Hemoglobin' => optional($record->labResults)->hemoglobin,
                'Gula Darah' => optional($record->labResults)->gda,
                'Urine' => optional($record->labResults)->ua,
                'KB' => optional($record->family_planning),
                'Keluhan' => optional($record->complaints),
                'Diagnosa' => optional($record->diagnosis),
                'Penyakit' => optional($record->diseases),
                'Obat' => optional($record->medication),
            ];
        });

        $filePath = "exports/medical-records_{$year}.xlsx";
        (new FastExcel($formattedRecords))->export(storage_path("app/{$filePath}"));

        Cache::put($cacheKey, $filePath, now()->addHours(1));

        return response()->download(storage_path("app/{$filePath}"));
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
        $medicalRecord = MedicalRecord::with('patient', 'labResults', 'vitalStatistics')->findOrFail($id);

        return view('posyandu.edit', compact('medicalRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $medicalRecord = MedicalRecord::with('patient', 'labResults', 'vitalStatistics')->findOrFail($id);

        // Validate the request data
        $request->validate([
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
        ]);

        // Update the medical record
        $medicalRecord->patient->update([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'nik' => $request->input('nik'),
            'place_of_birth' => $request->input('place_of_birth'),
            'birthdate' => $request->input('birthdate'),
            'dukuh' => $request->input('dukuh'),
            'rt' => $request->input('rt'),
            'rw' => $request->input('rw'),
            'age_group' => $request->input('age_group'),
        ]);

        $medicalRecord->vitalStatistics->update([
            'weight' => $request->input('weight'),
            'height' => $request->input('height'),
            'abdominal_circumference' => $request->input('abdominal_circumference'),
            'arm_circumference' => $request->input('arm_circumference'),
            'head_circumference' => $request->input('head_circumference'),
        ]);

        $medicalRecord->labResults->update([
            'cholesterol' => $request->input('cholesterol'),
            'hemoglobin' => $request->input('hemoglobin'),
            'gda' => $request->input('gda'),
            'ua' => $request->input('ua'),
        ]);

        $medicalRecord->complaints = $request->input('complaints');
        $medicalRecord->diagnosis = $request->input('diagnosis');
        $medicalRecord->medication = $request->input('medication');
        $medicalRecord->diseases = $request->input('diseases');
        $medicalRecord->save();

        return redirect()->back()->with('success', __('Medical record updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $medicalRecords = MedicalRecord::findOrFail($id);
        $medicalRecords->vitalStatistics()->delete();
        $medicalRecords->labResults()->delete();
        $medicalRecords->delete();

        return redirect()->back()->with('success', __('Medical record deleted successfully'));
    }
}
