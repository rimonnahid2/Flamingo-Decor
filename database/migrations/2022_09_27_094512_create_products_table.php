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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('subcate_id')->nullable();
            $table->foreign('subcate_id')->references('id')->on('subcates')->onDelete('cascade');
            $table->unsignedBigInteger('website_id')->nullable();
            $table->foreign('website_id')->references('id')->on('websites')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('image');//coverimg
            $table->integer('price');//coverimg
            $table->integer('discount');
            $table->longText('summary')->nullable();
            $table->longText('link');
            $table->longText('shipping_info')->nullable();
            $table->longText('note')->nullable();
            $table->text('meta_tag')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('trend')->nullable();
            $table->string('top_1')->nullable();
            $table->string('offer')->nullable();
            $table->string('today_offer')->nullable();
            $table->string('best_rated')->nullable();
            $table->string('slider')->nullable();
            $table->string('hot_deal')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('products');
    }
};
