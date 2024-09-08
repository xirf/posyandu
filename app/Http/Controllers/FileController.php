<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
    public function upload(Request $request) {
        if ($request->file('image')) {

            if (is_array($request->image)) {
                $path = collect($request->image)->map(function ($image) {
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    Storage::disk('public')->putFileAs('images', $image, $filename);
                    return 'images/' . $filename;
                });
            } else {
                $filename = uniqid() . '.' . $request->image->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('images', $request->image, $filename);
                $path = 'images/' . $filename;
            }

            return response()->json([
                'url' => 'storage/' . $path
            ], 200);
        }

        return;
    }


    public function getAllImages(Request $request) {
        $allFiles = Storage::allFiles('public');

        $imageFiles = array_filter($allFiles, function ($file) {
            return preg_match('/\.(jpg|jpeg|png|gif|svg|webp)$/i', $file);
        });

        return response()->json(array_values($imageFiles));
    }
}
