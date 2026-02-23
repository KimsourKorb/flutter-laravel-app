<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\{University, Major, Favorite};
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // Remove the constructor completely - middleware is in routes

    public function index(Request $request)
    {
        $favorites = $request->user()->favorites()->with('favorable')->get();

        $universities = [];
        $majors = [];

        foreach ($favorites as $favorite) {
            if ($favorite->favorable_type === University::class) {
                $universities[] = $favorite->favorable;
            } elseif ($favorite->favorable_type === Major::class) {
                $majors[] = $favorite->favorable;
            }
        }

        return response()->json([
            'universities' => $universities,
            'majors' => $majors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:university,major',
            'id' => 'required|integer',
        ]);

        $modelClass = $request->type === 'university' ? University::class : Major::class;
        $model = $modelClass::findOrFail($request->id);

        $favorite = Favorite::firstOrCreate([
            'user_id' => $request->user()->id,
            'favorable_type' => $modelClass,
            'favorable_id' => $model->id,
        ]);

        return response()->json([
            'message' => 'Added to favorites',
            'favorite' => $favorite,
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:university,major',
        ]);

        $modelClass = $request->type === 'university' ? University::class : Major::class;

        $deleted = Favorite::where('user_id', $request->user()->id)
                          ->where('favorable_type', $modelClass)
                          ->where('favorable_id', $id)
                          ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Removed from favorites']);
        }

        return response()->json(['message' => 'Favorite not found'], 404);
    }
}