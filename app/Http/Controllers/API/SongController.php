<?php

namespace App\Http\Controllers\API;

use App\Artist;
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [

        ]);

        $id = Str::random(32);
        Song::create([
            'id' => $id,
            'title' => 'qwerty',
            'length' => '144',
            'path' => 'app/music/face-umorist.mp3'
        ]);

        return response()->json();
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

        $path = storage_path($song->path);

        $response = new BinaryFileResponse($path);
        BinaryFileResponse::trustXSendfileTypeHeader();

        return $response;
    }


    public function upload(Request $request, getID3 $getID3)
    {
        $this->validate($request, [
            'track' => 'required'
        ]);

        $file = $request->file('track');

        $path = $file->store('music');

        $infoPath = storage_path('app/' . $path);

        $info = $getID3->analyze($infoPath);
        getid3_lib::CopyTagsToComments($info);

        $title = $info['comments']['title'] ?? '';
        $artistName = $info['comments']['artist'] ?? '';
        $picture = $info['id3v2']['APIC'][0]['data'];


        $mime = $info['id3v2']['APIC'][0]['image_mime'] ?? 'image/jpeg';
        $base64Image = 'data:' . $mime . ';base64,' . base64_encode($picture);

        return response()->json([
            'message' => 'Uploaded',
            'info' => [
                'title' => $title[0],
                'artist' => $artistName[0],
                'image' => $base64Image
            ]
        ]);
    }
}
