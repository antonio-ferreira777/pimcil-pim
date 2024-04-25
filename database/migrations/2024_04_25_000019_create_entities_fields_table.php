<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitiesFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('entities_fields', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('field_value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
