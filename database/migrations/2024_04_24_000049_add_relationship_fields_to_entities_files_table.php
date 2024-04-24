<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntitiesFilesTable extends Migration
{
    public function up()
    {
        Schema::table('entities_files', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->foreign('entity_id', 'entity_fk_9719778')->references('id')->on('entities');
            $table->unsignedBigInteger('file_id')->nullable();
            $table->foreign('file_id', 'file_fk_9719779')->references('id')->on('files');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9719783')->references('id')->on('statuses');
        });
    }
}
