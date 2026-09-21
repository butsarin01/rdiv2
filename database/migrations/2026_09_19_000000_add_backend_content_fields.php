<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->string('link_image', 250)->nullable();
            $table->string('link_personal', 250)->nullable();
            $table->boolean('status_show')->default(true);
        });
        Schema::table('banners', function (Blueprint $table) {
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('banners', fn (Blueprint $table) => $table->dropColumn(['date_start', 'date_end']));
        Schema::table('people', fn (Blueprint $table) => $table->dropColumn(['link_image', 'link_personal', 'status_show']));
    }
};
