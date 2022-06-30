<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargo = new Cargo();
        $cargo->cargo = "MONTADOR DE ESTRUCTURA A";
        $cargo->grupoAnalisis = "Cargo de prueba";
        $cargo->grupoCosto = "Cargo de prueba";
        $cargo->save();

        $supervisor = new Cargo();
        $supervisor->cargo = "SUPERVISOR DE MONTAJE II";
        $supervisor->grupoAnalisis = "Cargo de prueba";
        $supervisor->grupoCosto = "Cargo de prueba";
        $supervisor->save();
    }
}
