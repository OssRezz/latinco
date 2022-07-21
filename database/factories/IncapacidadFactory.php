<?php

namespace Database\Factories;

use App\Models\Empleado;
use App\Models\EstadoIncapacidad;
use App\Models\Incapacidad;
use App\Models\Observacion;
use App\Models\TipoIncapacidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Incapacidad>
 */
class IncapacidadFactory extends Factory
{
    protected $modal = Incapacidad::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $empleados = Empleado::select('id')->get();
        $tipo = TipoIncapacidad::select('id')->get();
        $estado = EstadoIncapacidad::select('id')->get();
        $observacion = Observacion::select('id')->get();
        return [
            'empleado_id' => $this->faker->randomElement($empleados)->id,
            'fkTipo' => $this->faker->randomElement($tipo)->id,
            'fechaInicio' => $this->faker->date(),
            'fechaFin' => $this->faker->date(),
            'totalDias' => $this->faker->numerify('#'),
            'diasEmpresa' => $this->faker->numerify('#'),
            'diasEps' => $this->faker->numerify('#'),
            'prorroga' => $this->faker->randomElement(['No', 'Si']),
            'acumulado_prorroga' => $this->faker->randomElement([120, 180, 2, 5, 6]),
            'numero_incapacidad' => $this->faker->numerify('#######'),
            'quincenas_nomina' => $this->faker->randomElement(['Primera quincena', 'Segunda quincena', 'Tercera quicena', 'Cuarta quincena']),
            'observacion_id' =>  $this->faker->randomElement($observacion)->id,
            'estado_incapacidad_id' =>  $this->faker->randomElement($estado)->id,
            'transcrita' => $this->faker->randomElement(['Si', 'No']),
            'tutela' => $this->faker->randomElement([0, 0]),
            'cartaProrroga' => $this->faker->randomElement([0, 0]),
            'valor_pendiente' => $this->faker->numerify('#########'),
            'created_at' => $this->faker->date(),
        ];
    }
}
