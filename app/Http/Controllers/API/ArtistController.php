<?php

namespace App\Http\Controllers\API;

use App\Album;
use App\Artist;
use App\Helpers\ImageCreator;
use App\Http\Controllers\Controller;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * Get all artists
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Artist::latest()->paginate(16);
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

    /**
     * Show an artist
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return response()->json([
            'artist' => Artist::with('albums', 'songs')->findOrFail($id)
        ]);
    }

    /**
     * Get artist's tracks
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function songs(int $id)
    {
        $songs = Song::whereIn('album_id', function($query) use ($id) {
            $query->select('id')->from('albums')->where('artist_id', $id);
        })->get();

        return response()->json([
            'songs' => $songs
        ]);
    }

    /**
     * Get artist's albums
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function albums(int $id)
    {
        $albums = Artist::findOrFail($id)->albums;

        return response()->json([
            'albums' => $albums
        ]);
    }

    public function updateAvatar(Request $request, int $artistId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        $path = $request->image->store('artist_avatars', 'public');

        $artist = Artist::findOrFail($artistId);
        $artist->image = '/storage/' . $path;
        $artist->save();

        return response()->json([
            'status' => 'Updated'
        ]);
    }
}
