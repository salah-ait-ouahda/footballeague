<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBordereausTable extends Migration
{
    public function up()
    {
        Schema::create('bordereaus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('etat');
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
