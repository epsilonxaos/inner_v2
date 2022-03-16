<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('instructor_id');
            $table->enum('tipo', ['classic','power','interval','sculpt','full body flow','yoga']) -> default('classic');
            $table->date('start');
            $table->date('end');
            $table->integer('limit_people') -> nullable();
            $table->text('description') -> nullable();
            $table->string('color', 100) -> nullable();
            $table->tinyInteger('status') -> default(0);
            $table->timestamps();

            $table->foreign('instructor_id')
                ->references('id')
                ->on('instructor')
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
        Schema::dropIfExists('lesson');
    }
}
