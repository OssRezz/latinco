<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\EstadoIncapacidad;
use App\Models\Incapacidad;
use App\Models\Transcripcion;
use Database\Factories\IncapacidadesFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CompaniaSeeder::class);
        $this->call(CoSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(TipoIncapacidadSeeder::class);
        $this->call(ObservacionSeeder::class);
        $this->call(EstadoIncapacidadSeeder::class);
        Empleado::factory(1000)->create();
        Incapacidad::factory(1000)->create();
        Transcripcion::factory(500)->create();
    }
}
