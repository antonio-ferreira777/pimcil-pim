<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalizationsTable extends Migration
{
    public function up()
    {
        Schema::create('localizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('data_table');
            $table->string('data');
            $table->string('data_value');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
