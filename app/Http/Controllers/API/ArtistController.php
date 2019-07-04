<?php

namespace App\Http\Controllers\API;

use App\Artist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
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
}
