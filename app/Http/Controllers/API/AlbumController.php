<?php

namespace App\Http\Controllers\API;

use App\Album;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Get all albums
     *
     * @return Album[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return response()->json([
            'albums' => Album::latest()->limit(20)->get()
        ]);
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
}
