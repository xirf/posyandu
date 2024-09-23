<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use App\Rules\NotEmptyContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $allTags = Tag::all();

        $allTags = $allTags->map(function ($tag) {
            return [
                'value' => $tag->name,
                'label' => $tag->name
            ];
        });


        return view('news.new', [
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

        // Generate a slug from the title
        $slug = Str::slug($validatedData['title']);

        // Check if the slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Create or find tags
        $tags = $request->tags;
        $tagsIDs = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagsIDs[] = $tag->id;
        }

        // Create the news post
        $post = News::create([
            'user_id' => Auth::user()->id,
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'published' ? News::STATUS_PUBLISHED : News::STATUS_DRAFT,
            'slug' => $slug,
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['about'],
            'published_at' => $validatedData['published_at'],
        ]);

        // Attach tags to the post
        $post->tags()->attach($tagsIDs);

        // Return to previous page with success message and data
        return redirect()->route('dashboard.news.edit', $post->id)->withInput()->with('success', __('News created successfully'));
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
        $post = News::with('tags')->findOrFail($id);
        $allTags = Tag::all();


        $allTags = $allTags->map(function ($tag) {
            return [
                'value' => $tag->name,
                'label' => $tag->name
            ];
        });

        return view('news.edit', compact('post', 'allTags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|string',
            'about' => [
                'required',
                'string',
                new NotEmptyContent
            ],
            'published_at' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'required|in:published,draft',
            'tags' => 'array'
        ]);

        // Find the existing news post
        $post = News::findOrFail($id);

        // Generate a slug from the title
        $slug = Str::slug($validatedData['title']);

        // Check if the slug is unique (excluding the current post)
        $originalSlug = $slug;
        $counter = 1;
        while (News::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Create or find tags
        $tags = $request->tags;
        $tagsIDs = [];
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagsIDs[] = $tag->id;
        }

        // Update the news post
        $post->update([
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'published' ? News::STATUS_PUBLISHED : News::STATUS_DRAFT,
            'slug' => $slug,
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['about'],
            'published_at' => \Carbon\Carbon::parse($validatedData['published_at']),
        ]);

        // Sync tags with the post
        $post->tags()->sync($tagsIDs);

        // Redirect to the edit page with success message
        return redirect()->route('dashboard.news.edit', $post->id)->with('success', __('News updated successfully'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
