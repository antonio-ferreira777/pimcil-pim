<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesVersioningsTable extends Migration
{
    public function up()
    {
        Schema::create('entities_versionings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('values');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
