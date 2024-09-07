<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;

class NewsController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('news.all');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('news.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|string',
            'about' => 'required|string',
            'published_at' => 'required|date',
            'status' => 'required|in:publish,draft',
            'tags' => 'array'
        ]);

        $tags = $request->tags;
        $tagsIDs = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagsIDs[] = $tag->id;
        }

        $post = News::create([
            'title' => $validatedData['title'],
            'slug' => str_replace(' ', '-', strtolower($validatedData['title'])),
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['about'],
            'published_at' => $validatedData['published_at'],
        ]);

        $post->tags()->attach($tagsIDs);
        return response()->json($post);
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
