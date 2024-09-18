<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityApiController extends Controller {
    public function index() {
        $activity = Activity::with(['user', 'tags'])->orderBy('updated_at', "desc")->paginate(50);

        return response()->json($activity);
    }

    public function delete(String $id) {
        $activity = Activity::find($id);

        if ($activity) {
            $activity->delete();
            return response()->json(['message' => 'activity deleted successfully']);
        }

        return response()->json(['message' => 'activity not found'], 404);
    }
};
