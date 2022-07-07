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
            $table->unsignedBigInteger('fkEmpleado');
            $table->unsignedBigInteger('fkTipo');
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->integer('totalDias');
            $table->integer('diasEmpresa');
            $table->integer('diasEps');
            $table->string('prorroga');
            $table->string('incapacidad_prorroga')->nullable();
            $table->integer('acumulado_prorroga');
            $table->string('numero_incapacidad');
            $table->string('quincenas_nomina');
            $table->unsignedBigInteger('observacion_id');
            $table->unsignedBigInteger('estado_id');
            $table->string('transcrita');
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
