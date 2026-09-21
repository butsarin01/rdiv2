<?php

namespace Tests\Feature;

use App\Http\Controllers\DocumentController;
use App\Models\document;
use App\Models\sub_document;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class DocumentControllerTest extends TestCase
{
    private DocumentController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Storage::fake('public');
        foreach (['type_documents', 'category_documents', 'title_documents'] as $table) {
            Schema::create($table, function (Blueprint $t) use ($table) {
                $t->increments('id');
                $t->string('name');
                $t->string('year')->nullable();
                $t->integer('type_quality_id')->nullable();
                if ($table !== 'type_documents') {
                    $t->unsignedInteger('type_document_id')->nullable();
                }
                if ($table === 'title_documents') {
                    $t->unsignedInteger('category_document_id');
                }
                if ($table === 'category_documents') {
                    $t->integer('ordinal')->nullable();
                }
                $t->timestamps();
            });
        }
        foreach (['sent_offices', 'level_documents', 'type_qualities', 'group_proples', 'years'] as $table) {
            Schema::create($table, function (Blueprint $t) {
                $t->id();
                $t->string('name')->nullable();
                $t->string('name_th')->nullable();
                $t->string('fullname')->nullable();
                $t->string('address')->nullable();
                $t->integer('borad_id')->nullable();
                $t->integer('ordinal')->nullable();
                $t->string('year')->nullable();
                $t->integer('type_quality_id')->nullable();
                $t->timestamps();
            });
        }
        Schema::create('documents', function (Blueprint $t) {
            $t->increments('id');
            foreach (['name', 'thumbnail', 'file', 'link', 'detail', 'number_document', 'date_announcement', 'year'] as $field) {
                $t->text($field)->nullable();
            }
            foreach (['ordinal', 'type_document_id', 'category_document_id', 'title_document_id', 'type_quality_id', 'sent_office_id', 'level_document_id', 'member_id_create', 'member_id_update'] as $field) {
                $t->integer($field)->nullable();
            }
            $t->integer('status_use')->default(1);
            $t->timestamps();
        });
        Schema::create('sub_documents', function (Blueprint $t) {
            $t->increments('id');
            $t->string('name')->nullable();
            $t->string('file');
            $t->unsignedInteger('document_id');
            foreach (['status_use', 'member_id_create', 'member_id_update', 'sent_office_id', 'level_document_id'] as $field) {
                $t->integer($field)->nullable();
            }
            $t->string('number_document')->nullable();
            $t->string('date_announcement')->nullable();
            $t->timestamps();
            $t->foreign('document_id')->references('id')->on('documents');
        });
        (require database_path('migrations/2026_09_19_000001_upgrade_document_management.php'))->up();
        session()->put('user', ['member_id' => 1, 'permission' => 1, 'ldap_username' => 'tester']);
        $this->controller = new class extends DocumentController
        {
            public function __construct() {}

            protected function showMenuv1($id = '')
            {
                return [];
            }
        };
    }

    private function request(array $data, array $files = []): Request
    {
        return Request::create('/', 'POST', $data, [], $files);
    }

    public function test_multi_uploads_use_saved_document_id_even_when_names_repeat(): void
    {
        foreach (['first', 'second'] as $contents) {
            $this->controller->document_insert($this->request(['name' => 'Same name', 'date_announcement' => '09/19/2569', 'member_id' => 999], [
                'multifilename' => [UploadedFile::fake()->createWithContent('attachment.txt', $contents)],
            ]));
        }
        $this->assertSame(2, document::count());
        $this->assertSame(2, sub_document::count());
        foreach (document::all() as $item) {
            $this->assertEquals(1, $item->member_id_create);
            $this->assertSame('2026-09-19', $item->date_announcement);
            $attachment = sub_document::where('document_id', $item->id)->sole();
            Storage::disk('public')->assertExists('sub_document/'.$item->id.'/'.$attachment->file);
        }
    }

    public function test_failed_attachment_save_rolls_back_document_and_new_files(): void
    {
        sub_document::creating(fn () => throw new \RuntimeException('Attachment failed'));
        try {
            $this->controller->document_insert($this->request(['name' => 'Failed'], [
                'filename' => UploadedFile::fake()->createWithContent('primary.txt', 'primary'),
                'multifilename' => [UploadedFile::fake()->createWithContent('attachment.txt', 'attachment')],
            ]));
            $this->fail('Save should fail.');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Attachment failed', $exception->getMessage());
            $this->assertSame(0, document::count());
            $this->assertSame([], Storage::disk('public')->allFiles());
        } finally {
            sub_document::flushEventListeners();
        }
    }

    public function test_update_preserves_absent_metadata_but_allows_clearing_link(): void
    {
        $id = DB::table('documents')->insertGetId(['name' => 'Old', 'link' => '/old', 'date_announcement' => '2025-01-01', 'member_id_create' => 8]);
        $this->controller->document_update($this->request(['id' => $id, 'name' => 'New', 'link' => '']));
        $item = document::findOrFail($id);
        $this->assertSame('New', $item->name);
        $this->assertSame('', $item->link);
        $this->assertSame('2025-01-01', $item->date_announcement);
        $this->assertEquals(8, $item->member_id_create);
        $this->assertEquals(1, $item->member_id_update);
    }

    public function test_legacy_attachment_is_replaced_and_deleted_in_parent_folder(): void
    {
        $parent = DB::table('documents')->insertGetId(['name' => 'Parent']);
        $id = DB::table('sub_documents')->insertGetId(['document_id' => $parent, 'file' => 'legacy.txt']);
        Storage::disk('public')->put('sub_document/legacy.txt', 'legacy');
        $this->controller->sub_document_insert($this->request(['id' => $id, 'document_id' => $parent, 'name' => 'Replacement'], [
            'filename' => UploadedFile::fake()->createWithContent('new.txt', 'replacement'),
        ]));
        $item = sub_document::findOrFail($id);
        Storage::disk('public')->assertMissing('sub_document/legacy.txt');
        Storage::disk('public')->assertExists('sub_document/'.$parent.'/'.$item->file);
        $this->controller->delete_sub_document($id);
        Storage::disk('public')->assertMissing('sub_document/'.$parent.'/'.$item->file);
    }

    public function test_invalid_hierarchy_and_dates_are_rejected(): void
    {
        $type = DB::table('type_documents')->insertGetId(['name' => 'Type']);
        $category = DB::table('category_documents')->insertGetId(['name' => 'Other category', 'type_document_id' => $type + 1]);
        foreach ([['type_document_id' => $type, 'category_document_id' => $category], ['date_announcement' => '02/31/2569']] as $input) {
            try {
                $this->controller->document_insert($this->request(['name' => 'Invalid'] + $input));
                $this->fail('Invalid input must fail.');
            } catch (ValidationException $exception) {
                $this->assertNotEmpty($exception->errors());
            }
        }
        $this->assertSame(0, document::count());
    }

    public function test_year_copy_keeps_hierarchy_and_does_not_duplicate_on_retry(): void
    {
        $type = DB::table('type_documents')->insertGetId(['name' => 'Type', 'mode' => 'report', 'year' => '2568']);
        $category = DB::table('category_documents')->insertGetId(['name' => 'Category', 'type_document_id' => $type, 'year' => '2568']);
        $title = DB::table('title_documents')->insertGetId(['name' => 'Title', 'type_document_id' => $type, 'category_document_id' => $category, 'year' => '2568', 'detail' => 'Keep detail']);
        DB::table('sub_title_documents')->insert(['name' => 'Subtitle', 'type_document_id' => $type, 'category_document_id' => $category, 'title_document_id' => $title, 'year' => '2568', 'code' => 'A']);
        for ($i = 0; $i < 2; $i++) {
            $this->controller->year_insert($this->request(['year' => '2569', 'mode' => 'report']));
        }
        $newType = DB::table('type_documents')->where('year', '2569')->sole();
        $newCategory = DB::table('category_documents')->where('type_document_id', $newType->id)->sole();
        $newTitle = DB::table('title_documents')->where('category_document_id', $newCategory->id)->sole();
        $newSubtitle = DB::table('sub_title_documents')->where('title_document_id', $newTitle->id)->sole();
        $this->assertEquals($newType->id, $newSubtitle->type_document_id);
        $this->assertEquals($newCategory->id, $newSubtitle->category_document_id);
        $this->assertSame('Keep detail', $newTitle->detail);
        $this->assertSame('A', $newSubtitle->code);
        $this->assertSame(1, DB::table('years')->where('year', '2569')->count());
    }

    public function test_classification_in_use_cannot_be_deleted_and_options_are_escaped(): void
    {
        $type = DB::table('type_documents')->insertGetId(['name' => 'Type']);
        $category = DB::table('category_documents')->insertGetId(['name' => '<script>unsafe</script>', 'type_document_id' => $type]);
        DB::table('documents')->insert(['name' => 'Document', 'type_document_id' => $type, 'category_document_id' => $category]);
        $html = $this->controller->fetch_category_document($this->request(['value' => $type]));
        $this->assertStringContainsString('&lt;script&gt;', $html);
        try {
            $this->controller->type_document_delete($type);
            $this->fail('Used classifications must not be deleted.');
        } catch (HttpException $exception) {
            $this->assertSame(422, $exception->getStatusCode());
            $this->assertSame(1, DB::table('category_documents')->count());
        }
    }

    public function test_course_create_edit_and_all_backend_views_render(): void
    {
        $type = DB::table('type_documents')->insertGetId(['name' => 'Course type', 'mode' => 'course']);
        $this->controller->insert_course($this->request(['title' => 'Course', 'type_document_id' => $type, 'link' => ['https://example.org']]));
        $id = DB::table('courses')->value('id');
        $this->controller->insert_course($this->request(['course_id' => $id, 'title' => 'Updated course', 'type_document_id' => $type]));
        $this->assertSame(1, DB::table('courses')->count());
        $this->assertStringContainsString('Updated course', $this->controller->index('course', $id)->render());
        foreach (['document', 'course', 'report'] as $mode) {
            $this->assertStringContainsString('form_add', $this->controller->setting_all($mode)->render());
        }
        $parent = DB::table('documents')->insertGetId(['name' => 'Attachment parent']);
        $this->assertStringContainsString('Attachment parent', $this->controller->sub_document($parent)->render());
        $this->assertStringContainsString('summernote_form', $this->controller->index()->render());
    }

    public function test_routes_only_reference_existing_document_actions(): void
    {
        foreach (app('router')->getRoutes() as $route) {
            if ($route->getAction('controller') && str_starts_with($route->getAction('controller'), DocumentController::class.'@')) {
                [, $method] = explode('@', $route->getAction('controller'));
                $this->assertTrue(method_exists(DocumentController::class, $method), $method.' must exist');
            }
        }
    }

    public function test_failed_update_keeps_original_document_and_file(): void
    {
        $id = DB::table('documents')->insertGetId(['name' => 'Original', 'file' => 'original.txt']);
        Storage::disk('public')->put('document/original.txt', 'original');
        sub_document::creating(fn () => throw new \RuntimeException('Attachment failed'));
        try {
            $this->controller->document_insert($this->request(['document_id' => $id, 'name' => 'Replacement'], [
                'filename' => UploadedFile::fake()->createWithContent('replacement.txt', 'new'),
                'multifilename' => [UploadedFile::fake()->createWithContent('attachment.txt', 'new')],
            ]));
            $this->fail('Expected save failure.');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Original', document::findOrFail($id)->name);
            $this->assertSame(['document/original.txt'], Storage::disk('public')->allFiles());
        } finally {
            sub_document::flushEventListeners();
        }
    }

    public function test_year_dropdown_filters_by_year_and_mode(): void
    {
        $qualityA = DB::table('type_qualities')->insertGetId(['name_th' => 'Quality A']);
        $qualityB = DB::table('type_qualities')->insertGetId(['name_th' => 'Quality B']);
        DB::table('type_documents')->insert([
            ['name' => 'Correct', 'year' => '2569', 'mode' => 'report', 'type_quality_id' => $qualityA],
            ['name' => 'Wrong quality', 'year' => '2569', 'mode' => 'report', 'type_quality_id' => $qualityB],
            ['name' => 'Wrong year', 'year' => '2568', 'mode' => 'report', 'type_quality_id' => $qualityA],
            ['name' => 'Wrong mode', 'year' => '2569', 'mode' => 'course', 'type_quality_id' => $qualityA],
        ]);
        $html = $this->controller->fetch_type_document($this->request([
            'source' => 'year', 'value' => '2569', 'base' => 'report', 'type_quality_id' => $qualityA,
        ]));
        $this->assertStringContainsString('Correct', $html);
        $this->assertStringNotContainsString('Wrong', $html);
    }

    public function test_quality_management_and_shared_document_settings_render(): void
    {
        $quality = DB::table('type_qualities')->insertGetId(['name_th' => 'QA group']);
        DB::table('years')->insert(['year' => '2569', 'type_quality_id' => $quality]);
        DB::table('type_documents')->insert([
            'name' => 'QA type',
            'mode' => 'report',
            'year' => '2569',
            'type_quality_id' => $quality,
        ]);

        $management = $this->controller->quality_index()->render();
        $settings = $this->controller->setting_all('qualities')->render();

        $this->assertStringContainsString('ข้อมูลประกันคุณภาพ', $management);
        $this->assertStringContainsString('รูปแบบประกันคุณภาพ', $management);
        $this->assertStringContainsString('QA group', $management);
        $this->assertStringContainsString('2569', $management);
        $this->assertStringContainsString('QA type', $management);
        $this->assertStringContainsString('จัดการรูปแบบประกันคุณภาพ', $settings);
        $this->assertStringContainsString('QA group', $settings);
    }

    public function test_quality_type_can_be_created_updated_and_only_unused_rows_deleted(): void
    {
        $this->controller->quality_save($this->request([
            'table' => 'quality',
            'name_quality' => 'New quality',
        ]));
        $id = DB::table('type_qualities')->value('id');

        $this->controller->quality_save($this->request([
            'table' => 'quality',
            'id_quality' => $id,
            'name_quality' => 'Updated quality',
        ]));
        $this->assertSame('Updated quality', DB::table('type_qualities')->value('name_th'));

        DB::table('years')->insert(['year' => '2569', 'type_quality_id' => $id]);
        try {
            $this->controller->quality_delete($id);
            $this->fail('Used quality type should not be deleted.');
        } catch (HttpException $exception) {
            $this->assertSame(422, $exception->getStatusCode());
        }
        DB::table('years')->delete();
        $this->controller->quality_delete($id);
        $this->assertDatabaseCount('type_qualities', 0);
    }

    public function test_sent_office_edit_uses_office_record_instead_of_document(): void
    {
        $id = DB::table('sent_offices')->insertGetId(['name' => 'Office', 'fullname' => 'Office full name', 'address' => 'Office address']);
        $html = $this->controller->sent_office($this->request(['id' => $id]))->render();
        $this->assertStringContainsString('value="Office full name"', $html);
        $this->assertStringContainsString('new bootstrap.Modal', $html);
    }
}
