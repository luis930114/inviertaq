<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistroEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registroempresa', function (Blueprint $table) {
            $table->increments('reem_id');
            $table->string('reem_nit', 255);
            $table->string('reem_nombre', 255);
            $table->string('reem_telefono', 50);
            $table->string('reem_direccion', 255);
            $table->string('reem_correo',255);
            $table->string('reem_codigo', 255)->unique();
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
        Schema::dropIfExists('registroempresa');
    }
}
