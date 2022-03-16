<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191) -> nullable();
            $table->integer('no_class') -> nullable();
            $table->decimal('price', 10, 2) -> nullable();
            $table->integer('duration') -> nullable();
            $table->tinyInteger('status') -> default(0);
            $table->tinyInteger('single_use') -> default(0);
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
        Schema::dropIfExists('package');
    }
}
