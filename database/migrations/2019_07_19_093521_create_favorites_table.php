<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites_table', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('micropost_id')->unsigned()->index();
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('micropost_id')->references('id')->on('microposts');
            
            // user_idとmicropost_idの組み合わせの重複を許さない
            $table->unique(['user_id', 'micropost_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorites_table');
    }
}
