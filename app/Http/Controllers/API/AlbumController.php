<?php

namespace App\Http\Controllers\API;

use App\Album;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AlbumController extends Controller
{
    /**
     * Get all albums
     *
     * @return Album[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Album::latest()->paginate(16);
    }

    /**
     * Get an album by id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return response()->json([
            'album' => Album::with('artist')->findOrFail($id)
        ]);
    }

    /**
     * Get tracks of an album
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function tracks(int $id)
    {
        return response()->json([
            'tracks' => Song::where('album_id', $id)->get()
        ]);
    }

    /**
     * Main page
     * Get albums from the cache
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function main()
    {
        $albums = Cache::remember('albums', 3600, function () {
            return Album::limit(8)->get();
        });

        return response()->json([
            'albums' => $albums
        ]);
    }
}
