<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldTaxonomyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('field_taxonomy', function (Blueprint $table) {
            $table->unsignedBigInteger('field_id');
            $table->foreign('field_id', 'field_id_fk_9722365')->references('id')->on('fields')->onDelete('cascade');
            $table->unsignedBigInteger('taxonomy_id');
            $table->foreign('taxonomy_id', 'taxonomy_id_fk_9722365')->references('id')->on('taxonomies')->onDelete('cascade');
        });
    }
}
