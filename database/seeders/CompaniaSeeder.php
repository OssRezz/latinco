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
        $latinco->tipo_compania = 1;
        $latinco->save();


        $comapania = new Compania();
        $comapania->nombre = "CONSORCIO ANDINO";
        $comapania->tipo_compania = 0;
        $comapania->save();
    }
}
