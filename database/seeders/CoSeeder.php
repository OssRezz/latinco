<?php

namespace Database\Seeders;

use App\Models\Co;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $oficinaPrincipal->codigo = "113";
        $oficinaPrincipal->nombre = "PUENTE BERMUDEZ -  CHACHAGUI";
        $oficinaPrincipal->save();


        $bodega = new Co();
        $bodega->fkCompania = 2;
        $bodega->codigo = "129";
        $bodega->nombre = "PUENTE ZULIA EN CUCUTA-N.SANTANDER";
        $bodega->save();
    }
}
