<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mode_article_id')->nullable();
            $table->foreign('mode_article_id')->references('id')->on('mode_articles');
            $table->string('title', 250)->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->string('img', 250)->nullable();
            $table->text('place')->nullable();
            $table->longtext('detail')->nullable();
            $table->unsignedInteger('ordinal')->nullable();
            $table->string('file', 250)->nullable();

            $table->bigInteger('people_id')->nullable();
            // $table->unsignedBigInteger('people_id')->nullable();
            // $table->foreign('people_id')->references('id')->on('people');

            $table->bigInteger('group_people_id')->nullable();
            // $table->unsignedBigInteger('group_people_id')->nullable();
            // $table->foreign('group_people_id')->references('id')->on('group_peoples');

            $table->unsignedInteger('member_id_create')->nullable();
            $table->foreign('member_id_create')->references('id')->on('members');
            $table->unsignedInteger('member_id_update')->nullable();
            $table->foreign('member_id_update')->references('id')->on('members');

            $table->string('account_action')->nullable();
            $table->string('ip_address')->nullable();
            $table->dateTime('date_save')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
