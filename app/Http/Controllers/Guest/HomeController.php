<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\News;
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
        $news = News::orderBy('created_at', 'desc')->limit(3)->get();
        $activities = Activity::orderBy('created_at', 'desc')->limit(3)->get();

        $news->map(function ($item) {
            $item->excerpt = $item->getExcerptAttribute($item->content);
            return $item;
        });

        return view('home.home', compact('news', 'activities'));
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
