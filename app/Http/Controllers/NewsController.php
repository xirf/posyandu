<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use App\Rules\NotEmptyContent;
use Illuminate\Http\Request;

class NewsController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $name = "news";
        return view('newsAndActivity.all', [
            'name' => $name
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $allTags = Tag::all();

        // convert to [['value' => 'All The Time', 'label' => 'All The Time'], ['value' => 'Angles', 'label' => 'Angles']]
        $allTags = $allTags->map(function ($tag) {
            return [
                'value' => $tag->name,
                'label' => $tag->name
            ];
        });


        return view('newsAndActivity.new', [
            'tags' => $allTags,
            'name' => 'news',
            'submit_to' => route('dashboard.news.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|string',
            'about' => [
                'required',
                'string',
                new NotEmptyContent
            ],
            'published_at' => 'required|date',
            'status' => 'required|in:published,draft',
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
            'status' => $validatedData['status'] === 'published' ? News::STATUS_PUBLISHED : News::STATUS_DRAFT,
            'slug' => str_replace(' ', '-', strtolower($validatedData['title'])),
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['about'],
            'published_at' => $validatedData['published_at'],
        ]);


        $post->tags()->attach($tagsIDs);
        // return to previous page with success message and data
        return redirect()->back()->with('success', __('News created successfully'));
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
