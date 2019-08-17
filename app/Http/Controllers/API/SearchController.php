<?php

namespace App\Http\Controllers\API;

use App\Album;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if (empty($request->q)) {
            return response()->json('Nothing found');
        }

        $query = $request->q;
        $queryParts = explode(' ', $query);

        $queryPart = array_shift($queryParts);
        $songs = Song::where('title', 'like', "%{$queryPart}%");
        $albums = Album::where('name', 'like', "%{$queryPart}%");

        foreach ($queryParts as $queryPart) {
            $songs->orWhere('title', 'like', "%{$queryPart}%");
            $albums->orWhere('name', 'like', "%{$queryPart}%");
        }

        return response()->json([
            'tracks' => $songs->limit(10)->get(),
            'tracks_count' => $songs->count(),

            'albums' => $albums->limit(4)->get(),
            'albums_count' => $albums->count()
        ]);
    }
}
