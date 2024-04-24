<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('default')->nullable();
            $table->boolean('nullable')->default(0)->nullable();
            $table->boolean('channels_transversality')->default(0)->nullable();
            $table->boolean('language_transversality')->default(0)->nullable();
            $table->integer('display_order')->nullable();
            $table->string('data_source')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
