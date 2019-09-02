<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use WithFaker;

    public function testUserCanRegisterWithValidData()
    {
        $response = $this->json('POST', '/api/v1/register', [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'SecretPass',
            'password_confirmation' => 'SecretPass'
        ]);

        $response->assertStatus(201);
    }

    public function testAuthenticatedUserCanLogout()
    {
        $user = factory(User::class)->create();
        $token = $user->createToken('TestToken', [])->accessToken;

        Passport::actingAs($user);

        $this->assertNotNull($user->tokens()->first());

        $response = $this->json('POST', '/api/v1/logout')->withHeaders([
            'Authorization' => 'Bearer ' . $token
        ]);

        $this->assertNull($user->tokens()->first());
    }
}
