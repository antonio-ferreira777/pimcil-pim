<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuggestsValuesTable extends Migration
{
    public function up()
    {
        Schema::create('suggests_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->longText('description')->nullable();
            $table->string('table_link')->nullable();
            $table->integer('table_link_value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
