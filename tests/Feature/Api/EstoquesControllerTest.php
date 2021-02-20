<?php

namespace Tests\Feature\Api\Estoques;

use App\Models\Estoque;
use App\Models\Produto;
use App\Models\ProdutoVariacao;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EstoquesControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testEstoquesIndex()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('estoques.index'), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);

    }

    public function testEstoqueShow()
    {
        $user = User::factory()->create();
        $estoque = Estoque::factory()
        ->for(
            ProdutoVariacao::factory()->for(Produto::factory()->state([
                "nome"=>"nome",
                "codigo"=>"codigo".uniqid(),
                "preco"=>0,
            ]))
        )
        ->create();

        $this->json('GET', route('estoques.show', $estoque->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testEstoqueStore()
    {
        $user = User::factory()->create();
        $produtoVariacao = ProdutoVariacao::factory()->for(Produto::factory()->state([
            "nome"=>"nome",
            "codigo"=>"codigo".uniqid(),
            "preco"=>0,
        ]))->create();

        $data = [
            "data"=> "2019-01-01",
            "quantidade"=> 101,
            "tipo_movimento"=> "ENTRADA",    
            "produto_variacao" => array(
                "id" => $produtoVariacao->id
            )
        ];

        $response = $this->json('POST', route('estoques.store'), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ]);



        $response->assertStatus(201);

	}

    public function testEstoqueUpdate()
    {
        $user = User::factory()->create();

        $produtoVariacao = ProdutoVariacao::factory()->for(Produto::factory()->state([
            "nome"=>"nome",
            "codigo"=>"codigo".uniqid(),
            "preco"=>0,
        ]))->create();

        $estoque = Estoque::factory()
        ->for(
            ProdutoVariacao::factory()->for(Produto::factory()->state([
                "nome"=>"nome",
                "codigo"=>"codigo".uniqid(),
                "preco"=>0,
            ]))
        )
        ->create();

        $data = [          
            "data"=> "2019-01-01",
            "quantidade"=> 1011,
            "tipo_movimento"=> "ENTRADA",
            "produto_variacao" => array(
                "id" => $produtoVariacao->id
            )
        ];
        
        $this->json('PUT', route('estoques.update', $estoque->id), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testEstoqueDelete()
    { 
        $estoque = Estoque::factory()
        ->for(
            ProdutoVariacao::factory()->for(Produto::factory()->state([
                "nome"=>"nome",
                "codigo"=>"codigo".uniqid(),
                "preco"=>0,
            ]))
        )
        ->create();
        
        $user = User::factory()->create();

        $this->json('DELETE', route('estoques.destroy', $estoque->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(204);
    }
}
