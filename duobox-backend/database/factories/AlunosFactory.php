<?php

namespace Database\Factories;

use App\Models\Alunos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alunos>
 */
class AlunosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alunos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'dat_nascimento' => $this->faker->date(),
        ];
    }
}
