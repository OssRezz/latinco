<?php

namespace Database\Factories;

use App\Models\Incapacidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transcripcion>
 */
class TranscripcionFactory extends Factory
{
    protected $modal = Incapacidad::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $incapacidad = Incapacidad::select('id')->get();
        return [
            'incapacidad_id' => $this->faker->unique()->randomElement($incapacidad)->id,
            'fechaActualizacion' => $this->faker->date(),
            'fechaPago' => $this->faker->date(),
            'valorRecuperado' => $this->faker->numerify('#########'),
            'valorPendiente' => $this->faker->numerify('#########'),
        ];
    }
}
