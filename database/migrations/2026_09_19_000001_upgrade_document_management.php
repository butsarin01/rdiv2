<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('type_documents', 'mode')) {
            Schema::table('type_documents', function (Blueprint $table) {
                $table->string('mode', 20)->default('document');
                $table->unsignedInteger('ordinal')->default(0);
            });
        }
        DB::table('type_documents')->whereNotNull('type_quality_id')->update(['mode' => 'report']);
        if (! Schema::hasColumn('title_documents', 'ordinal')) {
            Schema::table('title_documents', function (Blueprint $table) {
                $table->unsignedInteger('ordinal')->default(0);
                $table->text('detail')->nullable();
            });
        }
        if (! Schema::hasTable('sub_title_documents')) {
            Schema::create('sub_title_documents', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code', 250)->nullable();
                $table->string('name', 250);
                $table->text('detail')->nullable();
                $table->unsignedInteger('type_document_id');
                $table->unsignedInteger('category_document_id');
                $table->unsignedInteger('title_document_id');
                $table->string('year', 5)->nullable();
                $table->integer('type_quality_id')->nullable();
                $table->unsignedInteger('ordinal')->default(0);
                $table->timestamps();
                $table->foreign('type_document_id')->references('id')->on('type_documents');
                $table->foreign('category_document_id')->references('id')->on('category_documents');
                $table->foreign('title_document_id')->references('id')->on('title_documents');
            });
        }
        if (! Schema::hasColumn('documents', 'sub_title_document_id')) {
            Schema::table('documents', fn (Blueprint $table) => $table->unsignedInteger('sub_title_document_id')->nullable());
        }
        $this->addSubtitleForeignKey();
        if (! Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                foreach (['title', 'title_eng', 'title_short', 'title_short_eng', 'unit', 'course_open', 'thumbnail'] as $column) {
                    $table->string($column, 250)->nullable();
                }
                foreach (['occupation', 'detail', 'link'] as $column) {
                    $table->text($column)->nullable();
                }
                $table->unsignedInteger('type_document_id')->nullable();
                $table->unsignedInteger('category_document_id')->nullable();
                $table->integer('group_people_id')->nullable();
                $table->boolean('status_use')->default(true);
                $table->string('account_action')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->dateTime('date_save')->nullable();
                $table->timestamps();
                $table->foreign('type_document_id')->references('id')->on('type_documents');
                $table->foreign('category_document_id')->references('id')->on('category_documents');
            });
        }
    }

    private function addSubtitleForeignKey(): void
    {
        if (DB::getDriverName() !== 'mysql') {
            Schema::table('documents', fn (Blueprint $table) => $table->foreign('sub_title_document_id')->references('id')->on('sub_title_documents'));

            return;
        }
        $exists = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::connection()->getDatabaseName())
            ->where('TABLE_NAME', 'documents')->where('COLUMN_NAME', 'sub_title_document_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')->exists();
        if ($exists) {
            return;
        }

        // Keep legacy zero dates intact while MySQL rebuilds the existing table.
        $original = DB::selectOne('SELECT @@SESSION.sql_mode AS mode')->mode;
        $compatible = implode(',', array_diff(explode(',', $original), ['NO_ZERO_DATE', 'NO_ZERO_IN_DATE']));
        try {
            DB::statement('SET SESSION sql_mode = ?', [$compatible]);
            Schema::table('documents', fn (Blueprint $table) => $table->foreign('sub_title_document_id')->references('id')->on('sub_title_documents'));
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$original]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['sub_title_document_id']);
            $table->dropColumn('sub_title_document_id');
        });
        Schema::dropIfExists('sub_title_documents');
        Schema::table('title_documents', fn (Blueprint $table) => $table->dropColumn(['ordinal', 'detail']));
        Schema::table('type_documents', fn (Blueprint $table) => $table->dropColumn(['mode', 'ordinal']));
    }
};
