<?php

namespace App\Http\Controllers\API;

use App\Artist;
use App\Helpers\ImageCreator;
use App\Helpers\MetadataParsers\TagsParser;
use App\Http\Controllers\Controller;
use App\Song;
use Exception;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class SongController extends Controller
{
    /**
     * Get all songs
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'songs' => Song::latest()->limit(20)->get()
        ]);
    }

    /**
     * Store a new song
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request): JsonResponse
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
            // Process the file
            try {
                $tagsParser = new TagsParser(storage_path('app/music/' . $track['filename']), app()->make(getID3::class));

                $coverPath = 'music_images/' . Str::random(16);

                // Store images
                $imageCreator = new ImageCreator();
                $cover = $imageCreator->store($coverPath, $tagsParser->getCover(), $tagsParser->getCoverMime());
                $cover = asset('storage/' . $cover);

                $album->cover = $cover;
                $album->save();

                $id = Str::random(32);
                $album->songs()->create([
                    'id' => $id,
                    'title' => $track['title'],
                    'length' => $track['length'],
                    'path' => 'music/' . $track['filename'],
                    'cover' => $cover,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Cannot process the file'
                ]);
            }
        }

        return response()->json([
            'message' => 'Created',
            'artist' => [
                'id' => $artist->id,
                'was_created' => $artist->wasRecentlyCreated
            ]
        ], 201);
    }

    /**
     * Send the song file to the user
     *
     * @param string $id
     * @return BinaryFileResponse|JsonResponse
     */
    public function show(string $id)
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
     * Upload tracks and return metadata from the tracks
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function upload(Request $request): JsonResponse
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

            try {
                $tagsParser = new TagsParser($infoPath, app()->make(getID3::class));

                $info[$i] = [
                    'filename' => $tagsParser->getFilename(),
                    'title' => $tagsParser->getTitle(),
                    'artist' => $tagsParser->getArtist(),
                    'album' => $tagsParser->getAlbum(),
                    'length' => $tagsParser->getLength(),
                    'image' => $tagsParser->base64Cover()
                ];
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Cannot process the file'
                ]);
            }
        }

        return response()->json([
            'message' => 'Uploaded',
            'info' => $info
        ]);
    }
}
