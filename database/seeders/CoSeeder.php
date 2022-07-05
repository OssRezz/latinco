<?php

namespace Database\Seeders;

use App\Models\Co;
use Illuminate\Database\Seeder;

class CoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $cos = [
            [      
                'codigo'        => "113",
                'nombre'        => "PUENTE BERMUDEZ -  CHACHAGUI",
                'compania_id'   => 1,
            ],
            [      
                'codigo'         => "129",
                'nombre'         => "PUENTE ZULIA EN CUCUTA-N.SANTANDER",
                'compania_id'    => 2,
            ],
        ];

        Co::insert($cos);
    }
}
