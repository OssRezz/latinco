<?php

namespace Database\Seeders;

use App\Models\Observacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObservacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transcrita = new Observacion();
        $transcrita->observacion = 'Transcrita';
        $transcrita->save();

        $Pagada = new Observacion();
        $Pagada->observacion = 'Pagada';
        $Pagada->save();

        $baja = new Observacion();
        $baja->observacion = 'Dar de baja';
        $baja->save();
    }
}
