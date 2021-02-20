<?php

namespace Tests\Feature\Api\Atributos;

use App\Models\Atributo;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AtributosControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testAtributosIndex()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('atributos.index'), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);

    }

    public function testAtributoShow()
    {
        $user = User::factory()->create();
        $atributo = Atributo::factory()->create();
        
        $this->json('GET', route('atributos.show', $atributo->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testAtributoStore()
    {
        $user = User::factory()->create();

        $data = [
            'nome' => "title #2",
            'codigo' => "codigo #".uniqId(),
            'preco' => "10",            
        ];

        $response = $this->json('POST', route('atributos.store'), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ]);



        $response->assertStatus(201);

	}

    public function testAtributoUpdate()
    {
        $user = User::factory()->create();

        $data = [
            'id' => 1,
            'nome' => "nome #1",
            'codigo' => "codigo ".uniqId(),
            'preco' => "101",     
        ];
        
        $this->json('PUT', route('atributos.update', 1), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testAtributoDelete()
    {
        $atributo = Atributo::factory()->create();
        $user = User::factory()->create();

        $this->json('DELETE', route('atributos.destroy', $atributo->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(204);
    }
}
