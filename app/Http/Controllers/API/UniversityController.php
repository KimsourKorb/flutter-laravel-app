<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $query = University::with(['majors.category'])
                          ->where('is_active', true);

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('country')) {
            $query->where('country', $request->country);
        }

        $universities = $query->orderBy('ranking', 'asc')
                             ->paginate(15);

        // Add is_favorite for authenticated users
        if ($request->user()) {
            $universities->getCollection()->transform(function ($university) use ($request) {
                $university->is_favorite = $university->isFavoritedBy($request->user()->id);
                return $university;
            });
        }

        return response()->json($universities);
    }

    public function show(Request $request, $id)
    {
        $university = University::with([
            'majors.category',
            'majors.careerPaths'
        ])->findOrFail($id);

        if ($request->user()) {
            $university->is_favorite = $university->isFavoritedBy($request->user()->id);
        }

        return response()->json($university);
    }
}