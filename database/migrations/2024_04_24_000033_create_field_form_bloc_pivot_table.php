<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldFormBlocPivotTable extends Migration
{
    public function up()
    {
        Schema::create('field_form_bloc', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id', 'field_id_fk_9716788')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('form_bloc_id');
            $table->foreign('form_bloc_id', 'form_bloc_id_fk_9716788')->references('id')->on('form_blocs')->onDelete('cascade');
        });
    }
}
