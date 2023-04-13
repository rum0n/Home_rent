<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('post_title');
            $table->integer('bedrooms');
            $table->integer('batherooms');
            $table->integer('balconies');
            $table->integer('monthly_rent');
            $table->string('email');
            $table->string('post_picture')->default('default.jpg');
            $table->text('description');
            $table->string('address');
            $table->string('lat')->nullable();;
            $table->string('lon')->nullable();
            $table->boolean('is_approved')->default('1');
            $table->string('mobile_no');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
