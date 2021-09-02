<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('especie_id');
            $table->unsignedBigInteger('variedad_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('tamano_id');
            $table->unsignedBigInteger('unidadMedida_id');
            $table->double('cantidad');
            $table->boolean('activo');
            $table->foreign('especie_id')->references('id')->on('especies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('variedad_id')->references('id')->on('variedads')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tamano_id')->references('id')->on('tamanos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unidadMedida_id')->references('id')->on('unidad_medidas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('productos');
    }
}
