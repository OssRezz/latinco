<?php

namespace Database\Seeders;

use App\Models\Compania;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $compania = [
            [      
                'nombre'             => 'LATINCO',
                'tipo_compania'      => 1,
            ],
            [      
                'nombre'             => 'CONSORCIO ANDINO',
                'tipo_compania'      => 0,
            ],
        ];

        Compania::insert($compania);
    }
}
