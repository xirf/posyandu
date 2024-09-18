<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Tag;
use App\Rules\NotEmptyContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'medias' => 'required|json',
            'status' => 'required|in:published,draft',
            'tags' => 'array',
            'published_at' => 'required|date'
        ]);

        $tags = $request->tags;
        $tagsIDs = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagsIDs[] = $tag->id;
        }

        $post = Activity::create([
            'user_id' => Auth::user()->id,
            'title' => $validatedData['title'],
            'status' => $validatedData['status'] === 'published' ? Activity::STATUS_PUBLISHED : Activity::STATUS_DRAFT,
            'slug' => str_replace(' ', '-', strtolower($validatedData['title'])),
            'thumbnail' => $validatedData['thumbnail'],
            'content' => $validatedData['about'],
            'medias' => $validatedData['medias'],
            'published_at' => $validatedData['published_at'],
        ]);


        $post->tags()->attach($tagsIDs);
        // return to previous page with success message and data
        return redirect()->back()->with('success', __('Activity created successfully'));
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
