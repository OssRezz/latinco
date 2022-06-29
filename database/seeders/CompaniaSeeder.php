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
        $latinco = new Compania();
        $latinco->nombre = "LATINCO";
        $latinco->tipoCompania = 1;
        $latinco->save();


        $comapania = new Compania();
        $comapania->nombre = "CONSORCIO ANDINO";
        $comapania->tipoCompania = 0;
        $comapania->save();
    }
}
