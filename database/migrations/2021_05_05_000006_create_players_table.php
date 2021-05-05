<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('prenom');
            $table->string('tranche');
            $table->string('cine')->nullable();
            $table->string('sexe');
            $table->date('birthday_date');
            $table->string('status')->nullable();
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
