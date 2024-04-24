<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVariationsTable extends Migration
{
    public function up()
    {
        Schema::table('variations', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id', 'entity_fk_9720283')->references('id')->on('entities');
            $table->unsignedBigInteger('field_id')->nullable();
            $table->foreign('field_id', 'field_fk_9720284')->references('id')->on('fields');
            $table->unsignedBigInteger('master_entity_id')->nullable();
            $table->foreign('master_entity_id', 'master_entity_fk_9720285')->references('id')->on('entities');
        });
    }
}
