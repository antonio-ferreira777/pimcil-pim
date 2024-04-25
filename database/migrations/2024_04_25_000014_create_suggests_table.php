<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestsTable extends Migration
{
    public function up()
    {
        Schema::create('suggests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('editable');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
