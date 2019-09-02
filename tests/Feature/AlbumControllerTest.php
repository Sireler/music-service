<?php

namespace Tests\Feature;

use App\Album;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AlbumControllerTest extends TestCase
{
    /**
     * AlbumController.show
     */
    public function testShowAction(): void
    {
        $album = factory(Album::class)->create();

        $response = $this->json('GET', '/api/v1/albums/' . $album->id);

        $response->assertJsonFragment([
            'name' => $album->name
        ]);
    }

    /**
     * AlbumController.index
     */
    public function testIndexAction(): void
    {
        factory(Album::class, 16)->create();

        $response = $this->json('GET', '/api/v1/albums');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    /**
     * AlbumController.main
     */
    public function testMainAction(): void
    {
        factory(Album::class, 8)->create();

        $response = $this->json('GET', '/api/v1/main');

        $response->assertJson([
            'albums' => true
        ]);
    }

    /**
     * Refresh the table
     */
    protected function tearDown(): void
    {
        DB::table('albums')->delete();
    }
}
