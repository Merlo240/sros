<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBacheosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bacheos', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('calle_id');
            $table->string('barrio');
            $table->string('calle');
            $table->integer('numeracion');
            $table->string('largo');
            $table->string('ancho');
            $table->string('mts');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->mediumText('coordenadas');
            // $table->foreign('calle_id')->references('id')->on('calles')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bacheos');
    }
}
