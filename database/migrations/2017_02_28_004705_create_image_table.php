<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('images',function(Blueprint $table){
            $table->increments('id')->index();
            $table->integer('user_id')->unsigned();
            $table->integer('article_id')->unsigned()->nullable();
            $table->string('path')->nullable();
            $table->foreign('user_id')->references('id')->on('users');//外键
            $table->foreign('article_id')->references('id')->on('articles');//外键
        });
    }

    /**
     * Reverse the migrations. 
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
    }
}