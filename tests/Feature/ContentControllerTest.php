<?php

namespace Tests\Feature;

use App\Http\Controllers\ContentController;
use App\Models\banner;
use App\Models\detail_menu;
use App\Models\people;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ContentControllerTest extends TestCase
{
    private ContentController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Storage::fake('public');
        foreach (['main_menus', 'sub_menus'] as $table) {
            Schema::create($table, function (Blueprint $t) {
                $t->id();
                $t->string('name')->default('Menu');
                $t->integer('number_of_data')->default(2);
            });
        }
        foreach (['borads', 'positions', 'group_proples', 'prefix'] as $table) {
            Schema::create($table, function (Blueprint $t) {
                $t->id();
                $t->string('name')->default('Group');
                $t->integer('borad_id')->nullable();
                $t->integer('ordinal')->default(0);
                $t->integer('oridal')->default(0);
            });
        }
        Schema::create('people', function (Blueprint $t) {
            $t->id();
            foreach (['prefix_id', 'borad_id', 'position_id', 'group_prople_id', 'member_id_create', 'member_id_update', 'ordinal'] as $column) {
                $t->integer($column)->nullable();
            }
            foreach (['name', 'lastname', 'thumbnail', 'position_self', 'email', 'telephone', 'ldep_username'] as $column) {
                $t->string($column)->nullable();
            }
            $t->timestamps();
        });
        Schema::create('banners', function (Blueprint $t) {
            $t->id();
            foreach (['name', 'file', 'link', 'place'] as $column) {
                $t->string($column)->nullable();
            }
            $t->integer('ordinal')->default(0);
            $t->boolean('status_show')->default(false);
            $t->timestamps();
        });
        Schema::create('detail_menus', function (Blueprint $t) {
            $t->id();
            foreach (['title', 'detail', 'thumbnail', 'file', 'link', 'start_date', 'end_date'] as $column) {
                $t->text($column)->nullable();
            }
            foreach (['main_menu_id', 'sub_menu_id', 'member_id_create', 'member_id_update', 'number_show'] as $column) {
                $t->integer($column)->nullable();
            }
            $t->timestamps();
        });
        (require database_path('migrations/2026_09_19_000000_add_backend_content_fields.php'))->up();
        DB::table('main_menus')->insert(['id' => 1, 'number_of_data' => 2]);
        DB::table('sub_menus')->insert(['id' => 2, 'number_of_data' => 1]);
        DB::table('borads')->insert(['id' => 1]);
        session()->put('user', ['member_id' => 7, 'permission' => 1]);
        $this->controller = new class extends ContentController
        {
            public function __construct() {}

            protected function showMenuv1($id = '')
            {
                return [];
            }
        };
    }

    public function test_content_index_supports_query_mode_and_single_or_multiple_records(): void
    {
        DB::table('detail_menus')->insert(['main_menu_id' => 1, 'title' => 'List item']);
        DB::table('detail_menus')->insert(['sub_menu_id' => 2, 'title' => 'Single item']);
        $this->app->instance('request', Request::create('/content/1?mode=main'));
        $list = $this->controller->index(1);
        $this->assertCount(1, $list->getData()['data_detail_menu_all']);
        $this->assertNull($list->getData()['data_detail_menu']);
        $this->assertStringContainsString('List item', $list->getData()['data_detail_menu_all'][0]->title);
        $single = $this->controller->index(2, 'sub');
        $this->assertSame('Single item', $single->getData()['data_detail_menu']->title);
        $this->assertStringContainsString('form_content', $single->render());
    }

    public function test_edit_accepts_existing_and_reference_parameter_order(): void
    {
        $id = DB::table('detail_menus')->insertGetId(['main_menu_id' => 1, 'title' => 'Edit']);
        foreach ([[$id, 1, 'main'], [1, 'main', $id]] as $arguments) {
            $view = $this->controller->edit_detail_menu(...$arguments);
            $this->assertSame($id, $view->getData()['data_detail_menu']->id);
        }
    }

    public function test_people_form_updates_in_place_and_preserves_creator(): void
    {
        $request = Request::create('/', 'POST', ['group_id' => 1, 'people_name' => 'First', 'member_id' => 999]);
        $this->controller->insert_people($request);
        $person = people::firstOrFail();
        session()->put('user.member_id', 8);
        $this->controller->insert_people(Request::create('/', 'POST', ['id' => $person->id, 'group_id' => 1, 'people_name' => 'Changed', 'status' => 0]));
        $this->assertSame(1, people::count());
        $person->refresh();
        $this->assertSame('Changed', $person->name);
        $this->assertEquals(7, $person->member_id_create);
        $this->assertEquals(8, $person->member_id_update);
        $this->assertEquals(0, $person->status_show);
        $this->assertStringContainsString('Changed', $this->controller->borad(1)->render());
    }

    public function test_content_keeps_dates_without_inputs_and_replaces_files_after_save(): void
    {
        Storage::disk('public')->put('file/old.txt', 'old');
        $id = DB::table('detail_menus')->insertGetId(['main_menu_id' => 1, 'file' => 'old.txt', 'start_date' => '2026-09-19']);
        $request = Request::create('/', 'POST', ['detail_menu_id' => $id, 'main_menu_id' => 1, 'title' => 'Updated', 'number_show' => 0]);
        $request->files->set('filename', UploadedFile::fake()->createWithContent('new.txt', 'new content'));
        $this->controller->insert_detail_menu($request);
        $detail = detail_menu::findOrFail($id);
        $this->assertSame('2026-09-19', $detail->start_date);
        $this->assertEquals(0, $detail->number_show);
        Storage::disk('public')->assertMissing('file/old.txt');
        Storage::disk('public')->assertExists('file/'.$detail->file);
        $this->controller->delete_detail_menu($id);
        Storage::disk('public')->assertMissing('file/'.$detail->file);
    }

    public function test_invalid_date_does_not_save_content(): void
    {
        try {
            $this->controller->insert_detail_menu(Request::create('/', 'POST', ['main_menu_id' => 1, 'start_date' => '02/31/2569']));
            $this->fail('Invalid dates must be rejected.');
        } catch (ValidationException $exception) {
            $this->assertArrayHasKey('start_date', $exception->errors());
            $this->assertSame(0, detail_menu::count());
        }
    }

    public function test_failed_save_preserves_old_file_and_removes_new_upload(): void
    {
        Storage::disk('public')->put('file/original.txt', 'original');
        $model = new class
        {
            public $file = 'original.txt';

            public function save(): void
            {
                throw new \RuntimeException('Save failed');
            }
        };
        $request = Request::create('/', 'POST');
        $request->files->set('filename', UploadedFile::fake()->createWithContent('replacement.txt', 'replacement'));
        $method = new \ReflectionMethod(ContentController::class, 'saveWithUploads');

        try {
            $method->invoke($this->controller, $model, $request, ['filename' => ['file', 'file']]);
            $this->fail('The failed save must propagate.');
        } catch (\RuntimeException $exception) {
            $this->assertSame('Save failed', $exception->getMessage());
            $this->assertSame(['file/original.txt'], Storage::disk('public')->allFiles('file'));
        }
    }

    public function test_edit_rejects_a_record_from_another_menu(): void
    {
        $id = DB::table('detail_menus')->insertGetId(['sub_menu_id' => 2, 'title' => 'Other menu']);
        $this->expectException(ModelNotFoundException::class);

        $this->controller->edit_detail_menu($id, 1, 'main');
    }

    public function test_top_and_popup_banners_remain_separate_and_render(): void
    {
        foreach (['top', 'popup'] as $place) {
            $this->controller->set_index_insert(Request::create('/', 'POST', ['place' => $place, 'name' => $place, 'ordinal' => 1, 'status_show' => 1]));
            $html = $this->controller->setting_index_top($place)->render();
            $this->assertStringContainsString('name="place" value="'.$place.'"', $html);
        }
        $this->assertSame(2, banner::count());
        $item = banner::where('place', 'popup')->firstOrFail();
        $response = $this->controller->toggle(Request::create('/', 'POST', ['id' => $item->id]));
        $this->assertFalse($response->getData()->status_show);
        $this->assertSame('popup', $this->controller->update_index_top($item->id, 'popup')->getData()['data_banner'][0]->place);
    }

    public function test_right_banner_batch_preserves_links_and_missing_checkbox_means_off(): void
    {
        $id = DB::table('banners')->insertGetId(['place' => 'right', 'link' => '/existing', 'status_show' => 1]);
        $this->controller->set_index_insert(Request::create('/', 'POST', ['place' => 'right', 'id' => [$id], 'name' => ['Updated'], 'ordinal' => [1]]));
        $item = banner::findOrFail($id);
        $this->assertSame('/existing', $item->link);
        $this->assertEquals(0, $item->status_show);
        $this->assertStringContainsString('Updated', $this->controller->setting_index(Request::create('/'))->render());
    }
}
