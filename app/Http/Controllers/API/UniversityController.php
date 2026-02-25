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

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $universities = $query->orderBy('ranking', 'asc')->paginate(15);

        // Append is_favorite for authenticated users
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
            'majors.careerPaths',
        ])->findOrFail($id);

        if ($request->user()) {
            $university->is_favorite = $university->isFavoritedBy($request->user()->id);
        }

        return response()->json($university);
    }
}