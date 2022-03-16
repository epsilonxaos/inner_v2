<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatPerClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mat_per_class', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mat_id');
            $table->unsignedBigInteger('lesson_id');
            $table->tinyInteger('status') -> default(1);
            $table->timestamps();

            $table->foreign('mat_id')
                ->references('id')
                ->on('mat');
            $table->foreign('lesson_id')
                ->references('id')
                ->on('lesson');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mat_per_class');
    }
}
