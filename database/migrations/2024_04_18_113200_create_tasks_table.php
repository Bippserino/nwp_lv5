<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('naziv_rada');
            $table->string('naziv_rada_eng');
            $table->text('zadatak_rada');
            $table->enum('tip_studija', ['stručni', 'preddiplomski', 'diplomski']);
            $table->unsignedBigInteger('nastavnik_id');
            $table->foreign('nastavnik_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
