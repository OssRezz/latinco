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

        $cargos = [
            [      
                'cargo'             => 'MONTADOR DE ESTRUCTURA A',
                'grupoAnalisis'     => 'Cargo de prueba',
                'grupoCosto'        => 'Cargo de prueba',
            ],
            [      
                'cargo'             => 'SUPERVISOR DE MONTAJE II',
                'grupoAnalisis'     => 'Cargo de prueba',
                'grupoCosto'        => 'Cargo de prueba',
            ],
        ];

        Cargo::insert($cargos);
    }
}
