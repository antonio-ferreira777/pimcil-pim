<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFylesTypesTable extends Migration
{
    public function up()
    {
        Schema::table('fyles_types', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9719999')->references('id')->on('statuses');
        });
    }
}
