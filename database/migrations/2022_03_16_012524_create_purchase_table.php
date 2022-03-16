<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('package_id');
            $table->decimal('price', 10, 2);
            $table->integer('no_class');
            $table->integer('use_class') -> default(0);
            $table->integer('duration');
            $table->tinyInteger('status') -> default(0);
            $table->tinyInteger('view') -> default(1);
            $table->string('reference_code', 250) -> nullable();
            $table->dateTime('date_expirate') -> nullable();
            $table->dateTime('date_payment') -> nullable();
            $table->enum('method_pay', ['conekta','tarjeta','efectivo','pagofacil','gratis', 'indefinido']) -> default('indefinido');
            $table->decimal('discount', 10, 2) -> default(0.00);
            $table->text('error_pay') -> nullable();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customer');
            $table->foreign('package_id')
                ->references('id')
                ->on('package');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
}
