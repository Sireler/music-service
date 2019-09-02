<?php

namespace Tests\Feature;

use App\Artist;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ArtistControllerTest extends TestCase
{
    use WithFaker;

    /**
     * ArtistController.create
     */
    public function testCreateAction(): void
    {
        $response = $this->json('POST', '/api/v1/artists/create', [
            'name' => $this->faker->name
        ]);

        $response
            ->assertJsonStructure([
                'message', 'data'
            ])->assertStatus(201);
    }

    /**
     * ArtistController.show
     */
    public function testShowAction(): void
    {
        $artist = factory(Artist::class)->create();

        $response = $this->json('GET', '/api/v1/artists/' . $artist->id);

        $response->assertJsonFragment([
            'name' => $artist->name
        ]);
    }

    /**
     * ArtistController.updateAvatar
     */
    public function testUpdateAvatarAction(): void
    {
        $artist = factory(Artist::class)->create();
        Storage::fake('public');

        $response = $this->json('POST', '/api/v1/artists/' . $artist->id . '/update/avatar', [
            'image' => $file = UploadedFile::fake()->image('avatar.jpg')
        ]);

        $response->assertStatus(200);

        $artist = Artist::find($artist->id);
        $path = preg_replace('/storage/', '', $artist->image);

        Storage::disk('public')->assertExists($path);
    }
}
