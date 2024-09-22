<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\News;
use App\Models\Schedule;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    /**
     * Show the form for creating the resource.
     */
    public function create(): never {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show() {
        // Current year
        $currentYear = now()->year;

        // Last year
        $lastYear = now()->subYear()->year;

        // Query for current year
        $currentYearPosyandus = MedicalRecord::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        // Query for last year
        $lastYearPosyandus = MedicalRecord::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', $lastYear)
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        $news = News::with('user:id,name')->select('title','slug', 'published_at', 'user_id' )->limit(3)->get();

        // Pass the data to the view
        return view('dashboard.index', compact('currentYearPosyandus', 'lastYearPosyandus', 'news'));
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit() {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request) {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never {
        abort(404);
    }
}
