<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('package_id');
            $table->string('title', 191);
            $table->tinyInteger('type');
            $table->decimal('discound', 10, 2) -> default(0.00);
            $table->enum('directed', ['publico', 'paquete']) -> default('publico');
            $table->date('start');
            $table->date('end');
            $table->integer('limit_use') -> default(0);
            $table->tinyInteger('status') -> default(0);
            $table->integer('uses') -> default(0);
            $table->timestamps();

            $table->foreign('package_id')
                ->references('id')
                ->on('package')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupon');
    }
}
