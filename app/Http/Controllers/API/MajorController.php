<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index(Request $request)
    {
        $query = Major::with(['category', 'universities'])
                     ->where('is_active', true);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $majors = $query->paginate(15);

        // Add is_favorite for authenticated users
        if ($request->user()) {
            $majors->getCollection()->transform(function ($major) use ($request) {
                $major->is_favorite = $major->favorites()
                                           ->where('user_id', $request->user()->id)
                                           ->exists();
                return $major;
            });
        }

        return response()->json($majors);
    }

    public function show(Request $request, $id)
    {
        $major = Major::with([
            'category',
            'universities',
            'careerPaths'
        ])->findOrFail($id);

        if ($request->user()) {
            $major->is_favorite = $major->favorites()
                                       ->where('user_id', $request->user()->id)
                                       ->exists();
        }

        return response()->json($major);
    }
}