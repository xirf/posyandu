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
                'Jenis Kelamin' => $record->patient->gender,
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
