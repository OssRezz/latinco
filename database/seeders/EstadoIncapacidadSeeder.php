<?php

namespace Database\Seeders;

use App\Models\EstadoIncapacidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoIncapacidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendiente = new EstadoIncapacidad();
        $pendiente->estado = 'PENDIENTE DE PAGO';
        $pendiente->color = 'latinco';
        $pendiente->save();

        $pruebaNegativa = new EstadoIncapacidad();
        $pruebaNegativa->estado = 'AISLAMIENTO - PRUEBA NEGATIVA - DAR BAJA';
        $pruebaNegativa->color = 'warning';
        $pruebaNegativa->save();

        $Negada = new EstadoIncapacidad();
        $Negada->estado = 'NEGADA - PERIODO URGENCIAS - DAR BAJA';
        $Negada->color = 'warning';
        $Negada->save();

        $Devolusion = new EstadoIncapacidad();
        $Devolusion->estado = 'DEVOLUCION - SIN SOPORTES';
        $Devolusion->color = 'info';
        $Devolusion->save();

        $NegadaBaja = new EstadoIncapacidad();
        $NegadaBaja->estado = 'NEGADA - PERIODO GESTION - DAR BAJA';
        $NegadaBaja->color = 'warning';
        $NegadaBaja->save();

        $Liquidada = new EstadoIncapacidad();
        $Liquidada->estado = 'EPS LIQUIDADA - DAR DE BAJA';
        $Liquidada->color = 'warning';
        $Liquidada->save();

        $Pagada = new EstadoIncapacidad();
        $Pagada->estado = 'PAGADA';
        $Pagada->color = 'success';
        $Pagada->save();

        $Cargo = new EstadoIncapacidad();
        $Cargo->estado = 'CARGO - EMPLEADOR';
        $Cargo->color = 'info';
        $Cargo->save();

        $incapacidad = new EstadoIncapacidad();
        $incapacidad->estado = '180 DIAS DE INCAPACIDAD - FONDO';
        $incapacidad->color = 'info';
        $incapacidad->save();
    }
}
