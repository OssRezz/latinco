<?php

namespace Database\Seeders;

use App\Models\TipoIncapacidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoIncapacidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enfermedad = new TipoIncapacidad();
        $enfermedad->tipo = 'Enfermedad general';
        $enfermedad->save();

        $accidente = new TipoIncapacidad();
        $accidente->tipo = 'Aciddente de trabajo';
        $accidente->save();


        $maternidad = new TipoIncapacidad();
        $maternidad->tipo = 'Maternidad';
        $maternidad->save();


        $paternidad = new TipoIncapacidad();
        $paternidad->tipo = 'Paternidad';
        $paternidad->save();
    }
}
