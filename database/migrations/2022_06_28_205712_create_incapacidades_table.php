<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incapacidades', function (Blueprint $table) {
            $table->id();
            $table->string('numero_incapacidad');
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('fkTipo');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->integer('totalDias');
            $table->integer('diasEmpresa');
            $table->integer('diasEps');
            $table->string('prorroga');
            $table->string('incapacidad_prorroga')->nullable();
            $table->integer('acumulado_prorroga');
            $table->string('numero_incapacidadEntidad')->nullable();
            $table->string('quincenas_nomina')->nullable();
            $table->unsignedBigInteger('observacion_id');
            $table->unsignedBigInteger('estado_incapacidad_id');
            $table->string('transcrita');
            $table->integer('tutela')->nullable();
            $table->integer('estadoTutela')->nullable();
            $table->integer('cartaProrroga')->nullable();
            $table->integer('estadoCartaProrroga')->nullable();
            $table->integer('estadoFondoPension')->nullable();
            $table->integer('valor_pendiente');
            $table->unsignedBigInteger('diagnostico_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incapacidades');
    }
};
