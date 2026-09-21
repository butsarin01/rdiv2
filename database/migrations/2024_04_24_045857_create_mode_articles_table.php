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
        Schema::create('mode_articles', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('name_eng',250)->nullable();
            $table->integer('number_show');

            $table->integer('status_use_title')->nullable();
            $table->integer('status_use_thumbnail')->nullable();
            $table->integer('status_use_detail')->nullable();
            $table->integer('status_use_date_start')->nullable();
            $table->integer('status_use_date_end')->nullable();
            $table->integer('status_use_gallery')->nullable();
            $table->integer('status_use_place')->nullable();
            $table->integer('status_use_file')->nullable();
            $table->integer('status_use_multiplefile')->nullable();
            $table->integer('status_use_link')->nullable();
            $table->integer('number_of_data')->nullable();
            $table->string('join_database')->nullable();
            $table->string('join_database_id')->nullable();
            $table->integer('status_setting');
            $table->integer('status_keep_data')->nullable();
            $table->integer('status_use_promote')->nullable();

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
        Schema::dropIfExists('mode_articles');
    }
};
