<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('mat_per_class_id');
            $table->tinyInteger('status') -> default(1);
            $table->timestamps();

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchase');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customer');
            $table->foreign('mat_per_class_id')
                ->references('id')
                ->on('mat_per_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation');
    }
}
