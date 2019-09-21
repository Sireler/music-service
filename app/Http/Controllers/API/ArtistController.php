<?php

namespace App\Http\Controllers\API;

use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
     * Update the specified artist
     *
     * @param Request $request
     * @param int $artistId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $artistId)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg'
        ]);

        $data = $request->all();

        $artist = Artist::findOrFail($artistId);

        if ($request->has('image')) {
            $imagePath = $request->image->store('artist_avatars', 'public');
            $data['image'] = '/storage/' . $imagePath;
        }

        $artist->update($data);

        return response()->json([
            'status' => 'Updated'
        ]);
    }
}
