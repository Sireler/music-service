<?php

namespace Tests\Feature;

use App\Song;
use Tests\TestCase;

class SongControllerTest extends TestCase
{
    /**
     * SongController.index
     */
    public function testIndexAction(): void
    {
        factory(Song::class, 5)->create();

        $response = $this->json('GET', '/api/v1/songs');

        $response
            ->assertStatus(200)
            ->assertJson([
                'songs' => true
            ]);
    }

    public function testShowActionNotFound(): void
    {
        $song = factory(Song::class)->create();

        $response = $this->json('GET', '/api/v1/song/' . $song->id);

        $response->assertJsonFragment([
            'message' => 'Track not found'
        ]);
    }
}
