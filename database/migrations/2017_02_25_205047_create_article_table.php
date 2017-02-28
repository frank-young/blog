<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    public function up() 
    {
        Schema::create('articles', function(Blueprint $table) {
            $table->increments('id');
                $table->string('title');
                $table->string('description');
                $table->string('image_path')->nullable();
                $table->string('self_sign')->nullable();
                $table->text('body')->nullable();
                $table->integer('user_id');
                $table->integer('cate_id');
                $table->integer('comment_id')->nullable();
                $table->integer('like_id')->nullable();
                $table->integer('like_num')->nullable();
                $table->integer('comment_num')->nullable();
                $table->integer('visit_num')->nullable();
                $table->timestamps();
        });
    }
}
