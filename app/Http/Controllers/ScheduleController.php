<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller {
    public function getAll(Request $request) {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $schedules = Schedule::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->get();

        return response()->json($schedules);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'location' => 'required|string'
        ]);

        $Schedule = Schedule::create($validated);
        if ($Schedule) {
            return redirect()->back()->with('status', __('Schedule created successfully'));
        } else {
            return redirect()->back()->withErrors(__('Failed to create schedule'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $schedule = Schedule::find($id);

        if ($schedule) {
            $schedule->delete();
            return redirect()->back()->with('status', __('Schedule deleted successfully'));
        } else {
            return redirect()->back()->withErrors(__('Failed to delete schedule'));
        }
    }

    /**
     * Display the resource.
     */
    public function show() {
        //
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
}
