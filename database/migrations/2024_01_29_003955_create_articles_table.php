<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('slug',255)->unique();
            $table->string('introduction',255);
            $table->string('image',255);
            $table->text('body');
            $table->boolean('status')->default(0);

            //Relation with users

        $table->unsignedBigInteger('user_id');
        $table->foreign('user_id')
             ->references('id')
             ->on('users')
             ->onDelete('set null');
            
            //Relation with categorys

        $table->unsignedBigInteger('category_id');
        $table->foreign('category_id')
             ->references('id')
             ->on('categories')
             ->onDelete('cascade');
        
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
        Schema::dropIfExists('articles');
    }
}
