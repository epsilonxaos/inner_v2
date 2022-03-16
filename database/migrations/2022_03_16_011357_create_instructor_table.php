<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('email', 100) -> nullable();
            $table->string('phone', 45) -> nullable();
            $table->string('color', 45) -> nullable();
            $table->text('description') -> nullable();
            $table->string('avatar', 191) -> nullable();
            $table->text('embed') -> nullable();
            $table->tinyInteger('status') -> default(0);
            $table->tinyInteger('status_externo') -> default(0);
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
        Schema::dropIfExists('instructor');
    }
}
