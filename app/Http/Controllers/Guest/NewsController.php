<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller {
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
        $news = News::latest()->with('user', 'tags');

        if (!Auth::user()) {
            $news->where('status', News::STATUS_PUBLISHED);
        }

        $news->paginate(11);

        return view('home.news', compact('news'));
    }

    public function show(String $slug) {
        $news = News::where('slug', $slug)->with('user')->firstOrFail();

        if (($news->status !== News::STATUS_PUBLISHED || !$news) && !Auth::user()) {
            abort(404);
        }

        $recomedations = News::with('user')
            ->where('status', News::STATUS_PUBLISHED)
            ->where('id', '!=', $news->id)
            ->inRandomOrder()
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('news.show', compact('news', 'recomedations'));
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
