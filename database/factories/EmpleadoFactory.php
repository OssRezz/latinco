<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Co;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empleado>
 */
class EmpleadoFactory extends Factory
{
    protected $modal = Empleado::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cedula' => $this->faker->unique()->numerify('###########'),
            'nombre' => $this->faker->name(),
            'fechaIngreso' => $this->faker->date(),
            'fechaRetiro' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['1', '2']),
            'salario' => $this->faker->randomNumber(),
            'eps' => $this->faker->randomElement(['Sura', 'Colsanitas', 'Coomeva']),
            'fkCo' => $this->faker->randomElement(['1', '2']),
            'fkCargo' => $this->faker->randomElement(['1', '2']),
        ];
    }
}
