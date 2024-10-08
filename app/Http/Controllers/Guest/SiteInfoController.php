<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\SiteInfo;
use App\Models\User;
use Illuminate\Http\Request;

class SiteInfoController extends Controller {
    public function index() {
        $users = User::all();
        $mysiteInfo = SiteInfo::first();

        return view('site-info.edit', compact('users', 'mysiteInfo'));
    }
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
        // Validate the request data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'json'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
        ]);

        // Find the first SiteInfo record
        $siteInfo = SiteInfo::first();

        if ($siteInfo) {
            // Update the existing record
            $siteInfo->update($validated);
        } else {
            // Create a new record if none exists
            SiteInfo::create($validated);
        }

        // Redirect back with a status message
        return redirect()->back()->with('status', 'Site info updated.');
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never {
        abort(404);
    }
}
