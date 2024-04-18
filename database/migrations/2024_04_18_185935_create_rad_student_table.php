<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadStudentTable extends Migration
{
    public function up()
    {
        Schema::create('rad_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rad_id');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->foreign('rad_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rad_student');
    }
}
