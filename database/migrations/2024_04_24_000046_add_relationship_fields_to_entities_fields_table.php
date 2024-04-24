<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntitiesFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('entities_fields', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id', 'entity_fk_9719799')->references('id')->on('entities');
            $table->unsignedBigInteger('field_id')->nullable();
            $table->foreign('field_id', 'field_fk_9719800')->references('id')->on('fields');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('language_id', 'language_fk_9719983')->references('id')->on('languages');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9719802')->references('id')->on('statuses');
        });
    }
}
