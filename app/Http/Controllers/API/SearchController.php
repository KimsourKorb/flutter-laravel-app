<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\{University, Major};
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return response()->json([
                'universities' => [],
                'majors' => [],
            ]);
        }

        $universities = University::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('city', 'like', "%{$query}%");
            })
            ->with('majors.category')
            ->limit(10)
            ->get();

        $majors = Major::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->with(['category', 'universities'])
            ->limit(10)
            ->get();

        return response()->json([
            'universities' => $universities,
            'majors'       => $majors,
        ]);
    }
}