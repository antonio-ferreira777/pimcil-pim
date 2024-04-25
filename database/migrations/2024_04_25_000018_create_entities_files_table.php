<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesFilesTable extends Migration
{
    public function up()
    {
        Schema::create('entities_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('display_order')->nullable();
            $table->boolean('is_default')->default(0);
            $table->boolean('to_use')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
