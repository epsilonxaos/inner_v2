<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id');
            $table->string('name', 100) ->nullable();
            $table->string('lastname', 100) ->nullable();
            $table->string('phone', 45) ->nullable();
            $table->string('email', 100) ->nullable();
            $table->string('address', 191) ->nullable();
            $table->string('city',45) ->nullable();
            $table->string('state', 45) ->nullable();
            $table->string('country', 45) ->nullable();
            $table->string('zip', 10) ->nullable();
            $table->string('cupon_name', 100) ->nullable();
            $table->tinyInteger('cupon_type') -> default(0);
            $table->decimal('cupon_value', 10, 2) -> default(0.00);

            $table->foreign('purchase_id')
                ->references('id')
                ->on('purchase')
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
        Schema::dropIfExists('purchase_data');
    }
}
