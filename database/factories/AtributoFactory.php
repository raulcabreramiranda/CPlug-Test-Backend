<?php

namespace Database\Factories;

use App\Models\Atributo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AtributoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Atributo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'  => $this->faker->name,        
        ];
    }
}