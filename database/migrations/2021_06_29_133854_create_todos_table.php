<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    //Create Table in Database
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('done')->default(0);
            $table->timestamps();
        });
    }

    //Remove Table from Database
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}