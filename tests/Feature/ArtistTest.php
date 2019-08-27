<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistTest extends TestCase
{
    use WithFaker;

    public function testCreateAction()
    {
        $response = $this->json('POST', '/api/v1/artists/create', [
            'name' => $this->faker->name
        ]);

        $response
            ->assertJsonStructure([
                'message', 'data'
            ])->assertStatus(201);
    }
}
