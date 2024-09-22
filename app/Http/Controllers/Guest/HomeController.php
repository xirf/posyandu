<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\News;
use App\Models\SiteInfo;
use Illuminate\Http\Request;

class HomeController extends Controller {
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
        $news = [];
        News::orderBy('created_at', 'desc')->chunk(100, function ($newsChunk) use (&$news) {
            foreach ($newsChunk as $item) {
                $news[] = $item;
            }
        });
            
        $activities = [];
        Activity::orderBy('created_at', 'desc')->chunk(100, function ($activitiesChunk) use (&$activities) {
            foreach ($activitiesChunk as $item) {
                $activities[] = $item;
            }
        });
    
        return view('home.home', compact('news', 'activities'));
    }

    public function about(){
        $about = SiteInfo::select('description')->first();
        return view('home.about', compact('about'));
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
