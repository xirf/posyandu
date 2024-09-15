<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $allFiles = Storage::allFiles('public');

        $imageFiles = array_filter($allFiles, function ($file) {
            return preg_match('/\.(jpg|jpeg|png|gif|svg|webp)$/i', $file);
        });

        // replace all /public/ with /storage/
        $imageFiles = array_map(function ($file) {
            return str_replace('public', '/storage', $file);
        }, $imageFiles);

        return response()->json(array_values($imageFiles));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        if ($request->file('image')) {

            if (is_array($request->image)) {
                $path = collect($request->image)->map(function ($image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('images', $image, $filename, [
                        'visibility' => 'public'
                    ]);
                    return 'images/' . $filename;
                });
            } else {
                $filename = uniqid() . '.' . $request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('images', $request->image, $filename, [
                    'visibility' => 'public'
                ]);
                $path = 'images/' . $filename;
            }

            return response()->json([
                'url' => Storage::url($path)
            ], 200);
        }

        return;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
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
