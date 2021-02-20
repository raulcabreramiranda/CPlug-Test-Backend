<?php

namespace Tests\Feature\Api\Produtos;

use App\Models\Produto;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutosControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testProdutosIndex()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('produtos.index'), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);

    }

    public function testProdutoShow()
    {
        $user = User::factory()->create();
        $produto = Produto::factory()->create();
        
        $this->json('GET', route('produtos.show', $produto->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testProdutoStore()
    {
        $user = User::factory()->create();

        $data = [
            'nome' => "title #2",
            'codigo' => "codigo #".uniqId(),
            'preco' => "10",            
        ];

        $response = $this->json('POST', route('produtos.store'), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ]);



        $response->assertStatus(201);

	}

    public function testProdutoUpdate()
    {
        $user = User::factory()->create();

        $data = [
            'id' => 1,
            'nome' => "nome #1",
            'codigo' => "codigo ".uniqId(),
            'preco' => "101",     
        ];
        
        $this->json('PUT', route('produtos.update', 1), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testProdutoDelete()
    {
        $produto = Produto::factory()->create();
        $user = User::factory()->create();

        $this->json('DELETE', route('produtos.destroy', $produto->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(204);
    }
}
