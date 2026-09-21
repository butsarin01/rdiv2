<?php

namespace Tests\Feature;

use App\Http\Controllers\Document2Controller;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class RdiRegisterTest extends TestCase
{
    private Document2Controller $controller;

    protected function setUp(): void
    {
        parent::setUp();
        config(['database.default' => 'sqlite', 'database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        Schema::create('document_actions', function (Blueprint $t) {
            $t->id();
            foreach (['number', 'string_number', 'date_register', 'office_from', 'office_to', 'title', 'account_active', 'year', 'type', 'comment', 'account_action', 'date_action'] as $field) {
                $t->string($field)->nullable();
            }
            $t->timestamps();
        });
        Schema::create('e_gqs', function (Blueprint $t) {
            $t->id();
            foreach (['year', 'runing_number', 'gp_number', 'title', 'type_project', 'budget', 'person_responsible', 'person_seller', 'date_save', 'comment', 'account_action', 'date_action'] as $field) {
                $t->string($field)->nullable();
            }
            $t->timestamps();
        });
        Schema::create('reference_nagas', function (Blueprint $t) {
            $t->id();
            foreach (['year', 'string_number', 'title', 'type', 'budget', 'account_action', 'date_action'] as $field) {
                $t->string($field)->nullable();
            }
            $t->timestamps();
        });
        $this->controller = new class extends Document2Controller
        {
            public function __construct() {}

            protected function showMenuv1($id = '')
            {
                return [];
            }
        };
        session()->put('user', ['permission' => 2, 'ldap_username' => 'tester']);
    }

    public function test_register_pages_use_backend_and_correct_document_type(): void
    {
        foreach ([1, 2] as $type) {
            $view = $this->controller->document_rdi($type);
            $this->assertSame('backend.rdi_document.document_yearly', $view->name());
            $html = $view->render();
            $this->assertStringContainsString('name="type" value="'.$type.'"', $html);
            $this->assertSame(1, substr_count($html, 'id="content"'));
        }
        foreach (['running', 'reference_naga'] as $method) {
            $view = $this->controller->$method();
            $this->assertStringStartsWith('backend.rdi_document.', $view->name());
            $this->assertStringContainsString('app-sidebar', $view->render());
        }
    }

    public function test_naga_years_count_all_records_and_default_to_latest_year(): void
    {
        DB::table('reference_nagas')->insert([
            ['year' => '2568', 'title' => 'Older record'],
            ['year' => '2569', 'title' => 'Latest A'],
            ['year' => '2569', 'title' => 'Latest B'],
            ['year' => null, 'title' => 'Unknown year'],
            ['year' => '', 'title' => 'Empty year'],
        ]);
        $view = $this->controller->reference_naga();
        $data = $view->getData();
        $this->assertSame('2569', $data['selectedYear']);
        $this->assertSame(5, $data['totalCount']);
        $this->assertEquals([2, 1, 2], $data['years']->pluck('total')->all());
        $this->assertCount(2, $data['document']);
        $this->assertStringNotContainsString('Older record', $view->render());

        foreach (['2568' => 1, 'all' => 5, 'unassigned' => 2, '2570' => 0] as $year => $count) {
            $this->app->instance('request', Request::create('/reference_naga/show', 'GET', ['year' => (string) $year]));
            $view = $this->controller->reference_naga();
            $this->assertCount($count, $view->getData()['document']);
            $this->assertSame(5, $view->getData()['totalCount']);
            if ($count === 0) {
                $this->assertStringContainsString('ไม่พบรายการในปีที่เลือก', $view->render());
            }
        }
    }

    public function test_naga_save_returns_to_year_of_saved_record(): void
    {
        $response = $this->controller->reference_naga_insert(Request::create('/', 'POST', ['year' => '2568', 'title' => 'Added']));
        $this->assertSame(route('reference_naga.show', ['year' => '2568']), $response->getTargetUrl());
        $this->assertSame('2568', DB::table('reference_nagas')->value('year'));
    }

    public function test_running_years_filter_table_counts_and_form(): void
    {
        DB::table('e_gqs')->insert([
            ['year' => '2568', 'title' => 'Previous year'],
            ['year' => '2569', 'title' => 'Latest A'],
            ['year' => '2569', 'title' => 'Latest B'],
            ['year' => null, 'title' => 'Unassigned'],
            ['year' => '', 'title' => 'Empty year'],
            ['year' => '25697', 'title' => 'Invalid legacy year'],
        ]);
        $view = $this->controller->running();
        $data = $view->getData();
        $this->assertSame('2569', $data['selectedYear']);
        $this->assertSame(6, $data['totalCount']);
        $this->assertCount(2, $data['document']);
        $this->assertEquals(2, $data['years']->firstWhere('year', '2569')->total);
        $html = $view->render();
        $this->assertStringContainsString('value="2569"', $html);
        $this->assertStringNotContainsString('Previous year', $html);
        foreach (['2568' => 1, 'all' => 6, 'unassigned' => 2, '2570' => 0, '25697' => 1] as $year => $count) {
            $this->app->instance('request', Request::create('/e_gp_running/show', 'GET', ['year' => (string) $year]));
            $view = $this->controller->running();
            $this->assertCount($count, $view->getData()['document']);
            $this->assertSame(6, $view->getData()['totalCount']);
            if ($count === 0) {
                $this->assertStringContainsString('ไม่พบรายการในปีที่เลือก', $view->render());
            }
        }
    }

    public function test_running_save_redirects_to_saved_year_and_update_does_not_duplicate(): void
    {
        $response = $this->controller->running_insert(Request::create('/', 'POST', ['year' => '2568', 'title' => 'Added']));
        $this->assertSame(route('running.show', ['year' => '2568']), $response->getTargetUrl());
        $id = DB::table('e_gqs')->value('id');
        $response = $this->controller->running_insert(Request::create('/', 'POST', ['id' => $id, 'year' => '2569', 'title' => 'Updated']));
        $this->assertSame(route('running.show', ['year' => '2569']), $response->getTargetUrl());
        $this->assertSame(1, DB::table('e_gqs')->count());
        $this->assertSame('2569', DB::table('e_gqs')->value('year'));
    }

    public function test_internal_document_year_counts_exclude_external_documents(): void
    {
        DB::table('document_actions')->insert([
            ['type' => 1, 'year' => '2570', 'string_number' => '001/2570', 'title' => 'External only'],
            ['type' => 2, 'year' => '2568', 'string_number' => '001/2568', 'title' => 'Previous internal'],
            ['type' => 2, 'year' => '2569', 'string_number' => '001/2569', 'title' => 'Latest internal A'],
            ['type' => 2, 'year' => '2569', 'string_number' => '001/2569', 'title' => 'Latest internal B'],
            ['type' => 2, 'year' => null, 'string_number' => null, 'title' => 'Unknown year'],
        ]);
        $view = $this->controller->document_rdi(2);
        $this->assertSame('2569', $view->getData()['selectedYear']);
        $this->assertSame(4, $view->getData()['totalCount']);
        $this->assertCount(2, $view->getData()['document']);
        $this->assertEquals(2, $view->getData()['years']->firstWhere('year', '2569')->total);
        $this->assertStringContainsString('001/2569', $view->render());
        foreach (['2568' => 1, 'all' => 4, 'unassigned' => 1, '2570' => 0] as $year => $count) {
            $this->app->instance('request', Request::create('/document_rdi/2', 'GET', ['year' => (string) $year]));
            $view = $this->controller->document_rdi(2);
            $this->assertCount($count, $view->getData()['document']);
            $this->assertSame(4, $view->getData()['totalCount']);
            $this->assertStringNotContainsString('External only', $view->render());
        }
        $response = $this->controller->document_rdi_insert(Request::create('/', 'POST', ['type' => 2, 'year' => '2568', 'string_number' => '001/2568', 'title' => 'Added internal']));
        $this->assertSame(route('document_rdi.show', ['id' => 2, 'year' => '2568']), $response->getTargetUrl());
    }

    public function test_external_document_year_counts_exclude_internal_documents(): void
    {
        DB::table('document_actions')->insert([
            ['type' => 2, 'year' => '2570', 'string_number' => '001/2570', 'title' => 'Internal only'],
            ['type' => 1, 'year' => '2568', 'string_number' => '001/2568', 'title' => 'Previous internal'],
            ['type' => 1, 'year' => '2569', 'string_number' => '001/2569', 'title' => 'Latest internal A'],
            ['type' => 1, 'year' => '2569', 'string_number' => '001/2569', 'title' => 'Latest internal B'],
            ['type' => 1, 'year' => null, 'string_number' => null, 'title' => 'Unknown year'],
        ]);
        $view = $this->controller->document_rdi(1);
        $this->assertSame('2569', $view->getData()['selectedYear']);
        $this->assertSame(4, $view->getData()['totalCount']);
        $this->assertCount(2, $view->getData()['document']);
        $this->assertEquals(2, $view->getData()['years']->firstWhere('year', '2569')->total);
        $this->assertStringContainsString('001/2569', $view->render());
        foreach (['2568' => 1, 'all' => 4, 'unassigned' => 1, '2570' => 0] as $year => $count) {
            $this->app->instance('request', Request::create('/document_rdi/1', 'GET', ['year' => (string) $year]));
            $view = $this->controller->document_rdi(1);
            $this->assertCount($count, $view->getData()['document']);
            $this->assertSame(4, $view->getData()['totalCount']);
            $this->assertStringNotContainsString('Internal only', $view->render());
        }
        $response = $this->controller->document_rdi_insert(Request::create('/', 'POST', ['type' => 1, 'year' => '2568', 'string_number' => '001/2568', 'title' => 'Added internal']));
        $this->assertSame(route('document_rdi.show', ['id' => 1, 'year' => '2568']), $response->getTargetUrl());
    }

    public function test_internal_documents_use_number_suffix_instead_of_date_or_stored_year(): void
    {
        DB::table('document_actions')->insert([
            ['type' => 2, 'string_number' => ' 0000/2568 ', 'year' => null, 'date_register' => '2025-10-15', 'title' => 'Legacy record'],
            ['type' => 2, 'string_number' => '0001/2569', 'year' => '2568', 'date_register' => '2025-10-15', 'title' => 'Explicit year'],
        ]);
        $this->app->instance('request', Request::create('/document_rdi/2', 'GET', ['year' => '2568']));
        $view = $this->controller->document_rdi(2);
        $this->assertCount(1, $view->getData()['document']);
        $this->assertSame('2568', $view->getData()['document'][0]->display_year);
        $this->assertStringContainsString('Legacy record', $view->render());
        $this->assertNull(DB::table('document_actions')->where('title', 'Legacy record')->value('year'));
    }

    public function test_outgoing_documents_keep_type_on_create_and_legacy_update(): void
    {
        foreach ([1, 2] as $type) {
            $this->controller->document_rdi_insert(Request::create('/', 'POST', ['title' => 'Type '.$type, 'type' => $type, 'year' => '2569']));
            $view = $this->controller->document_rdi($type);
            $this->assertCount(1, $view->getData()['document']);
            $this->assertEquals($type, $view->getData()['document'][0]->type);
        }
        $id = DB::table('document_actions')->where('type', 2)->value('id');
        $this->controller->document_rdi_insert(Request::create('/', 'POST', ['doc_id' => $id, 'type' => 2, 'title' => 'Edited']));
        $this->assertSame(2, DB::table('document_actions')->count());
        $this->assertSame('Edited', DB::table('document_actions')->where('id', $id)->value('title'));
    }

    public function test_legacy_permission_is_accepted_and_other_roles_are_denied(): void
    {
        session()->put('user', ['permisstion' => '3']);
        $this->assertSame('backend.rdi_document.running', $this->controller->running()->name());
        foreach ([0, 1, 4, 6] as $permission) {
            session()->put('user', ['permission' => $permission]);
            foreach (['running', 'reference_naga', 'document_rdi'] as $method) {
                try {
                    $this->controller->$method();
                    $this->fail('Access should be denied.');
                } catch (HttpException $exception) {
                    $this->assertSame(403, $exception->getStatusCode());
                }
            }
        }
    }
}
