<?php

namespace Database\Factories;

use App\Models\Estoque;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstoqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estoque::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantidade' => $this->faker->randomNumber(2),            
            'data' => $this->faker->date(),           
            'tipo_movimento' => $this->faker->boolean() == true ? Estoque::TIPO_MOVIMENTO_ENTRADA : Estoque::TIPO_MOVIMENTO_SAIDA ,            
        ];
    }
}