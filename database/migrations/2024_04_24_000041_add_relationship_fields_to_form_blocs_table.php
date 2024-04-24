<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFormBlocsTable extends Migration
{
    public function up()
    {
        Schema::table('form_blocs', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_9719771')->references('id')->on('statuses');
        });
    }
}
