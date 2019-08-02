<?php

namespace App\Http\Controllers\API;

use App\Artist;
use App\Helpers\ID3Parser;
use App\Helpers\ImageCreator;
use App\Http\Controllers\Controller;
use App\Song;
use getID3;
use getid3_lib;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SongController extends Controller
{
    /**
     * Get all songs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        return response()->json([
            'songs' => Song::all()
        ]);
    }

    /**
     * Store a new song
     *
     * @param Request $request
     * @param ID3Parser $parser
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request, ID3Parser $parser)
    {
        $this->validate($request, [
            'title' => 'required|max:30',
            'artist' => 'required|max:30',
            'album' => 'required|max:30',
            'length' => 'required',
            'filename' => 'required'
        ]);

        if (!Storage::disk('local')->exists('music/' . $request->get('filename'))) {
            return response()->json([
                'message' => 'Track not found'
            ]);
        }

        // Get info
        $parser->getTrackInfo(storage_path('app/music/' . $request->get('filename')));
        $picture = $parser->getPicture();
        $mime = $parser->getPictureMime();
        $picturePath = 'music_images/' . Str::random(16);

        // Store images
        $imageCreator = new ImageCreator();
        $cover = $imageCreator->store($picturePath, $picture, $mime);
        $cover = asset('storage/' . $cover);

        // Create models
        $artist = Artist::firstOrCreate(['name' => $request->get('artist')]);

        $album = $artist->albums()->firstOrCreate([
            'name' => $request->get('album'),
        ]);
        $album->cover = $cover;
        $album->save();

        $id = Str::random(32);
        $song = $album->songs()->create([
            'id' => $id,
            'title' => $request->get('title'),
            'length' => $request->get('length'),
            'path' => 'music/' . $request->get('filename'),
            'cover' => $cover,
        ]);

        return response()->json([
            'message' => 'Song created',
            'song' => $song,
            'artist_created' => $artist->wasRecentlyCreated
        ], 201);
    }

    /**
     * Send the song file to the user
     *
     * @param $id
     * @return BinaryFileResponse
     */
    public function song($id)
    {
        $song = Song::find($id);

        if (!Storage::disk('local')->exists($song->path)) {
            return response()->json(['message' => 'Track not found']);
        }

        $path = storage_path('app/' . $song->path);

        $response = new BinaryFileResponse($path);
        BinaryFileResponse::trustXSendfileTypeHeader();

        return $response;
    }

    /**
     * Upload a track and get id3 data to store in db
     *
     * @param Request $request
     * @param ID3Parser $parser
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function upload(Request $request, ID3Parser $parser)
    {
        $this->validate($request, [
            'track' => 'required'
        ]);

        if (!$request->hasFile('track')) {
            return response()->json(['message' => 'Upload error']);
        }

        $file = $request->file('track');

        $fileHash = str_replace('.' . $file->extension(), '', $file->hashName());
        $fileName = $fileHash . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('music', $fileName);


        $infoPath = storage_path('app/' . $path);

        $info = $parser->getTrackInfo($infoPath);

        return response()->json([
            'message' => 'Uploaded',
            'info' => $info
        ]);
    }
}
