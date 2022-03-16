<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortafolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portafolio', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('cover');
            $table->string('portada');
            $table->string('nombre');
            $table->text('descripcion') -> nullable();
            $table->tinyInteger('status') -> default(1);
            $table->unsignedBigInteger('categoria_id');

            $table->foreign('categoria_id')
                ->references('id') -> on('categorias')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('portafolio_galeria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img');
            $table->integer('order') -> default(0);
            $table->unsignedBigInteger('portafolio_id');

            $table->foreign('portafolio_id') -> references('id') -> on('portafolio') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portafolio_galeria');
        Schema::dropIfExists('portafolio');
    }
}
