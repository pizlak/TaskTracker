<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaries', function (Blueprint $table) {
            $table->id();
            $table->string('text_comment');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->timestamps();

            $table->index('user_id', 'commentary_user_idx');
            $table->index('user_id', 'commentary_image_idx');

            $table->foreign('user_id', 'commentary_user_fk')->references('id')->on('users');
            $table->foreign('image_id', 'commentary_image_fk')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaries');
    }
}
