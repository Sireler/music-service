<?php

namespace App\Http\Controllers\API;

use App\Artist;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Get all artists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        return response()->json([
            'artists' => Artist::all()
        ]);
    }

    /**
     * Store a new artist
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:artists'
        ]);

        return response()->json([
            'message' => 'Created',
            'data' => Artist::create($request->all())
        ], 201);
    }

    public function artist(Request $request, int $id)
    {
        return response()->json([
            'artist' => Artist::findOrFail($id)
        ]);
    }

    public function songs(Request $request, int $id)
    {
        $songs = Song::whereIn('album_id', function($query) use ($id) {
            $query->select('id')->from('albums')->where('artist_id', $id);
        })->get();

        return response()->json([
            'songs' => $songs
        ]);
    }
}
