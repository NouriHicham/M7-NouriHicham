<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Crea usuario admin y usuario normal
        $this->admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin'
        ]);
        $this->user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('12345678'),
            'role' => 'user'
        ]);
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);
        $response->assertStatus(201);
    }

    /** @test */
    public function admin_can_login()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@example.com',
            'password' => '12345678'
        ]);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    /** @test */
    public function user_can_login()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'user@example.com',
            'password' => '12345678'
        ]);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    /** @test */
    public function anyone_can_access_public_pokemons()
    {
        $response = $this->getJson('/api/public-pokemons');
        $response->assertStatus(200);
    }

    /** @test */
    public function anyone_can_list_and_show_pokemon()
    {
        $response = $this->getJson('/api/pokemon');
        $response->assertStatus(200);
        // show (id=1) puede fallar si no hay pokemons, depende de tu seed
        // $response = $this->getJson('/api/pokemon/1');
        // $response->assertStatus(200);
    }

    /** @test */
    public function user_auth_routes_require_auth()
    {
        $response = $this->postJson('/api/logout');
        $response->assertStatus(401);

        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
    }

    /** @test */
    public function user_can_access_user_routes()
    {
        $token = auth()->login($this->user);

        $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/logout')
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/user')
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/games')
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/categories')
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/my-pokemons')
            ->assertStatus(200);
    }

    /** @test */
    public function admin_can_access_admin_routes()
    {
        $token = auth()->login($this->admin);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/users')
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/user/' . $this->user->id)
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->putJson('/api/user/' . $this->user->id, ['name' => 'Nuevo Nombre'])
            ->assertStatus(200);

        $this->withHeader('Authorization', "Bearer $token")
            ->deleteJson('/api/user/' . $this->user->id)
            ->assertStatus(200);
    }

    /** @test */
    public function user_cannot_access_admin_routes()
    {
        $token = auth()->login($this->user);

        $this->withHeader('Authorization', "Bearer $token")
            ->getJson('/api/users')
            ->assertStatus(403);
    }

    /** @test */
    public function admin_and_user_can_create_pokemon()
    {
        $tokenAdmin = auth()->login($this->admin);
        $tokenUser = auth()->login($this->user);

        $data = [
            'name' => 'Pikachu',
            'category_id' => 1,
            // ...otros campos requeridos...
        ];

        $this->withHeader('Authorization', "Bearer $tokenAdmin")
            ->postJson('/api/pokemon', $data)
            ->assertStatus(201);

        $this->withHeader('Authorization', "Bearer $tokenUser")
            ->postJson('/api/pokemon', $data)
            ->assertStatus(201);
    }

    // Puedes seguir añadiendo tests para update, delete, ranking, etc.
}
