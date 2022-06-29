<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->foreign('fkCo')->references('id')->on('co');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints('empleados', function (Blueprint $table) {
            $table->dropForeign('empleados_fkCo_foreign');
        });
    }
};
