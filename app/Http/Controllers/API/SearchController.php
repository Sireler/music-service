<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->q;

        $songs = Song::where('title', 'like', '%' . $query . '%')->get();

        return response()->json([
            'tracks' => $songs
        ]);
    }
}
