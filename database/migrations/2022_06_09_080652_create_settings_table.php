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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('about')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('hotline')->nullable();
            $table->string('address')->nullable();
            $table->string('web_link')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('service_years')->nullable();
            $table->string('notice')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('cover_image')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
