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

        $oficinaPrincipal = new Co();
        $oficinaPrincipal->fkCompania = 1;
        $oficinaPrincipal->codigo = "001";
        $oficinaPrincipal->nombre = "Oficina princial";
        $oficinaPrincipal->save();


        $bodega = new Co();
        $bodega->fkCompania = 1;
        $bodega->codigo = "002";
        $bodega->nombre = "Bodega Medellin";
        $bodega->save();
    }
}
