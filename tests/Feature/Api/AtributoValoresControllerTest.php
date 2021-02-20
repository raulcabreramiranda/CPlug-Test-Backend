<?php

namespace Tests\Feature\Api\AtributoValors;

use App\Models\Atributo;
use App\Models\AtributoValor;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AtributoValorsControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testAtributoValorsIndex()
    {
        $user = User::factory()->create();

        $response = $this->json('GET', route('atributo_valores.index'), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);

    }

    public function testAtributoValorShow()
    {
        $user = User::factory()->create();
        $atributoValor = AtributoValor::factory()
                            ->for(Atributo::factory()->state([
                                'nome' => 'Jessica Archer',
                            ]))
                            ->create();

        $this->json('GET', route('atributo_valores.show', $atributoValor->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testAtributoValorStore()
    {
        $user = User::factory()->create();
        $atributo = Atributo::factory()->create();

        $data = [
            'valor' => "10",            
            'atributo' => array("id"=>$atributo->id),            
        ];

        $response = $this->json('POST', route('atributo_valores.store'), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ]);



        $response->assertStatus(201);

	}

    public function testAtributoValorUpdate()
    {
        $user = User::factory()->create();
        $atributo = Atributo::factory()->create();
        $atributoValor = AtributoValor::factory()
                            ->for(Atributo::factory()->state([
                                'nome' => 'Jessica Archer',
                            ]))
                            ->create();

        $data = [
            'valor' => "101",     
            'atributo' => array("id"=>$atributo->id), 
        ];
        
        $this->json('PUT', route('atributo_valores.update', $atributoValor->id), $data, [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => $user->username,
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(200);
    }

    public function testAtributoValorDelete()
    {
        $atributoValor = AtributoValor::factory()
                ->for(Atributo::factory()->state([
                    'nome' => 'Jessica Archer',
                ]))
                ->create();
        $user = User::factory()->create();

        $this->json('DELETE', route('atributo_valores.destroy', $atributoValor->id), [], [], [], [
            "HTTP_Authorization" => "Basic {base64_encode({$user->username} ':password')}",
            "PHP_AUTH_USER" => "$user->username",
            "PHP_AUTH_PW" => "password"
        ])->assertStatus(204);
    }
}
