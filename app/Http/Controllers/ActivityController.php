<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Tag;
use App\Rules\NotEmptyContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ActivityController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {

        return view('activity.all');
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


        return view('activity.new', [
            'tags' => $allTags,
            'name' => 'Activity',
            'submit_to' => route('dashboard.activity.store')
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
            'medias' => 'required|string',
            'status' => 'required|in:published,draft',
            'tags' => 'array'
        ]);

        // Generate a slug from the title
        $slug = Str::slug($validatedData['title']);

        // Check if the slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while (Activity::where('slug', $slug)->exists()) {
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

        // Create the Activity post
        $post = Activity::create([
            'user_id' => Auth::user()->id,
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'published' ? Activity::STATUS_PUBLISHED : Activity::STATUS_DRAFT,
            'slug' => $slug,
            'thumbnail' => $validatedData['thumbnail'],
            'medias' => $validatedData['medias'],
            'content' => $validatedData['about'],
            'published_at' => $validatedData['published_at'],
        ]);

        // Attach tags to the post
        $post->tags()->attach($tagsIDs);

        // Return to previous page with success message and data
        return redirect()->route('dashboard.activity.edit', $post->id)->withInput()->with('success', __('Activity created successfully'));
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
        $activity = Activity::with('tags')->findOrFail($id);
        $allTags = Tag::all();


        $allTags = $allTags->map(function ($tag) {
            return [
                'value' => $tag->name,
                'label' => $tag->name
            ];
        });

        return view('activity.edit', compact('activity', 'allTags'));
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

        // Find the existing Activity post
        $post = Activity::findOrFail($id);

        // Generate a slug from the title
        $slug = Str::slug($validatedData['title']);

        // Check if the slug is unique (excluding the current post)
        $originalSlug = $slug;
        $counter = 1;
        while (Activity::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
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

        // Update the Activity post
        $post->update([
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'published' ? Activity::STATUS_PUBLISHED : Activity::STATUS_DRAFT,
            'slug' => $slug,
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['about'],
            'published_at' => \Carbon\Carbon::parse($validatedData['published_at']),
        ]);

        // Sync tags with the post
        $post->tags()->sync($tagsIDs);

        // Redirect to the edit page with success message
        return redirect()->route('dashboard.activity.edit', $post->id)->with('success', __('Activity updated successfully'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
