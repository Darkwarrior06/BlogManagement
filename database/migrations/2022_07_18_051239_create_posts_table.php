<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('photo');
            $table->string('video');
            $table->string('title');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {

            $table->unsignedBigInteger('writer_id');
            $table->foreign('writer_id')->references('id')->on('writers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
