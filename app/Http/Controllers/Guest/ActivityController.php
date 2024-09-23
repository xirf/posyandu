<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller {
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
    public function showAll() {
        $activities = Activity::latest()->with('user', 'tags');

        if (!Auth::user()) {
            $activities->where('status', Activity::STATUS_PUBLISHED);
        }

        $activities->paginate(11);

        return view('activity.view', compact('activities'));
    }

    public function show($slug) {
        $activity = Activity::where('slug', $slug)->with('user')->firstOrFail();

        if (($activity->status !== 'published' || !$activity) && !Auth::user()) {
            abort(404);
        }

        $recommendations = Activity::with('user')
            ->where('status', 'published')
            ->where('id', '!=', $activity->id)
            ->inRandomOrder()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('activity.show', compact('activity', 'recommendations'));
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
