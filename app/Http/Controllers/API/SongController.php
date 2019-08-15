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
    public function index()
    {
        return response()->json([
            'songs' => Song::latest()->limit(20)->get()
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
            'tracks.*.title' => 'required|max:30',
            'tracks.*.artist' => 'required|max:30',
            'tracks.*.album' => 'required|max:30',
            'tracks.*.length' => 'required',
            'tracks.*.filename' => 'required'
        ]);

        $artist = Artist::firstOrCreate(['name' => $request->tracks[0]['artist']]);
        $album = $artist->albums()->firstOrCreate([
            'name' => $request->tracks[0]['album'],
        ]);

        foreach ($request->tracks as $i => $track) {

            if (!Storage::disk('local')->exists('music/' . $track['filename'])) {
                return response()->json([
                    'message' => 'Track not found'
                ]);
            }

            // Get info
            $parser->getTrackInfo(storage_path('app/music/' . $track['filename']));
            $picture = $parser->getPicture();
            $mime = $parser->getPictureMime();
            $picturePath = 'music_images/' . Str::random(16);

            // Store images
            $imageCreator = new ImageCreator();
            $cover = $imageCreator->store($picturePath, $picture, $mime);
            $cover = asset('storage/' . $cover);

            $album->cover = $cover;
            $album->save();

            $id = Str::random(32);
            $song = $album->songs()->create([
                'id' => $id,
                'title' => $track['title'],
                'length' => $track['length'],
                'path' => 'music/' . $track['filename'],
                'cover' => $cover,
            ]);
        }

        return response()->json([
            'message' => 'Song created',
            'artist' => [
                'id' => $artist->id,
                'was_created' => $artist->wasRecentlyCreated
            ]
        ], 201);
    }

    /**
     * Send the song file to the user
     *
     * @param $id
     * @return BinaryFileResponse
     */
    public function show($id)
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
            'track.*' => 'required|mimetypes:audio/mpeg'
        ]);

        $info = [];
        foreach ($request->track as $i => $track) {
            $fileHash = str_replace('.' . $track->extension(), '', $track->hashName());
            $fileName = $fileHash . '.' . $track->getClientOriginalExtension();

            $path = $track->storeAs('music', $fileName);

            $infoPath = storage_path('app/' . $path);

            $info[$i] = $parser->getTrackInfo($infoPath);
        }

        return response()->json([
            'message' => 'Uploaded',
            'info' => $info
        ]);
    }
}
