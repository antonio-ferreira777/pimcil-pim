<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormBlocsTable extends Migration
{
    public function up()
    {
        Schema::create('form_blocs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('display_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
