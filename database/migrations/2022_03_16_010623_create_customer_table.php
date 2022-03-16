<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191) -> nullable();
            $table->string('lastname', 191) -> nullable();
            $table->string('phone', 45) -> nullable();
            $table->string('email', 100) -> nullable();
            $table->string('address', 191) -> nullable();
            $table->string('city', 100) -> nullable();
            $table->string('state', 100) -> nullable();
            $table->string('country', 100) -> nullable();
            $table->string('zip', 10) -> nullable();
            $table->string('colony', 100) -> nullable();
            $table->date('birthday') -> nullable();
            $table->tinyInteger('status') -> default(1);
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
        Schema::dropIfExists('customer');
    }
}
