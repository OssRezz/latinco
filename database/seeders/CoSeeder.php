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
        $oficinaPrincipal->codigo = "113";
        $oficinaPrincipal->nombre = "PUENTE BERMUDEZ -  CHACHAGUI";
        $oficinaPrincipal->compania_id = 1;
        $oficinaPrincipal->save();


        $bodega = new Co();        
        $bodega->codigo = "129";
        $bodega->nombre = "PUENTE ZULIA EN CUCUTA-N.SANTANDER";
        $bodega->compania_id = 2;
        $bodega->save();
    }
}
