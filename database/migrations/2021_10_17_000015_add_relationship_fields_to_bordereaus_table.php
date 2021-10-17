<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBordereausTable extends Migration
{
    public function up()
    {
        Schema::table('bordereaus', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id', 'team_fk_3845418')->references('id')->on('teams');
        });
    }
}
