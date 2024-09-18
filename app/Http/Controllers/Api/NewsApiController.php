<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsApiController extends Controller {
    public function index() {
        $news = News::with(['user', 'tags'])->orderBy('updated_at', "desc")->paginate(50);

        return response()->json($news);
    }

    public function delete(String $id) {
        $news = News::find($id);

        if ($news) {
            $news->delete();
            return response()->json(['message' => 'News deleted successfully']);
        }

        return response()->json(['message' => 'News not found'], 404);
    }
};
