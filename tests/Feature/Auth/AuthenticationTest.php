<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }


    public function test_users_can_update_profile(): void
    {
        $user = User::factory()->create();

        $address = 'carrera 5';
        $brithdate = '1999-02-25';

       $response = $this->actingAs($user)->putJson('/profile', [
            'email' => $user->email,
            'name' => $user->name,
            'address' => $address ,
            'brithdate' => $brithdate,
            'city' => 'miami',
            'new_password' => '123456789',
            'current_password' => 'password'
        ]);

       $response->assertStatus(Response::HTTP_ACCEPTED);

        $response->assertSee($address);
        $response->assertSee($brithdate);
        $this->assertTrue(Hash::check('123456789', $user->password));
    }


    public function test_users_mark_favorite(): void
    {

        $user = User::factory()->create();

        $favorite = $this->actingAs($user)->postJson('/favorite/character', [
            'character_name' => 'Morti',
            'character_id' => 5
        ]);


        $favorite->assertStatus(Response::HTTP_CREATED);

        $favorite->assertSee('Morti');


        $response = $this->actingAs($user)->getJson('/favorite/characters');

        $response->assertSee('Morti');


        $id = $favorite->getData()->character_id;

        $response = $this->actingAs($user)->deleteJson("/favorite/character/{$id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);


    }
}
