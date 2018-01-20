<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_papers', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('class_room_id')->nullable();
          $table->uuid('user_id');
          $table->uuid('subject_id')->nullable();
          $table->uuid('exam_id')->nullable();
          $table->string('name');
          $table->string('code')->nullable();
          $table->integer('mark');
          $table->string('calc_mark')->nullable();
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
        Schema::dropIfExists('subject_papers');
    }
}
