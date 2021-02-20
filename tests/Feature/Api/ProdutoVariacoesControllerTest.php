<?php

namespace Tests\Feature\Api\ProdutoVariacaos;

use App\Models\Produto;
use App\Models\ProdutoVariacao;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProdutoVariacaosControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testProdutoVariacaosIndex()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('produto_variacoes.index'), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);

    }

    public function testProdutoVariacaoShow()
    {
        $user = User::factory()->create();
        $produtoVariacao = ProdutoVariacao::factory()->for(Produto::factory()->state([
            "nome"=>"nome",
            "codigo"=>"codigo".uniqid(),
            "preco"=>0,
        ]))->create();
        
        $this->json('GET', route('produto_variacoes.show', $produtoVariacao->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testProdutoVariacaoStore()
    {
        $user = User::factory()->create();
        $produto = Produto::factory()->create();
        $data = [          
            "produto" => array(
                "id" => $produto->id
            )
        ];

        $response = $this->json('POST', route('produto_variacoes.store'), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ]);



        $response->assertStatus(201);

	}

    public function testProdutoVariacaoUpdate()
    {
        $user = User::factory()->create();       
        $produtoVariacao = ProdutoVariacao::factory()->for(Produto::factory()->state([
            "nome"=>"nome",
            "codigo"=>"codigo".uniqid(),
            "preco"=>0,
        ]))->create();
        $produto = Produto::factory()->create();

        $data = [          
            "produto" => array(
                "id" => $produto->id
            )
        ];
        
        $this->json('PUT', route('produto_variacoes.update', $produtoVariacao->id), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testProdutoVariacaoDelete()
    {
        $produtoVariacao = ProdutoVariacao::factory()->for(Produto::factory()->state([
            "nome"=>"nome",
            "codigo"=>"codigo".uniqid(),
            "preco"=>0,
        ]))->create();

        $user = User::factory()->create();

        $this->json('DELETE', route('produto_variacoes.destroy', $produtoVariacao->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(204);
    }
}
