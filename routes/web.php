<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Document2Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['block.spam','throttle:frontend'])->group(function () {
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/Personnel={id?}', [FrontendController::class, 'board'])->name('index.board');
    Route::get('/Mode={mode?}/Id={id?}', [FrontendController::class, 'content_show'])->name('index.content_show');
    Route::get('/Activity', [FrontendController::class, 'activity_all'])->name('index.activity_all');
    Route::get('/Activity_detail={id?}', [FrontendController::class, 'activity_detail'])->name('index.activity_detail');
    Route::get('/News', [FrontendController::class, 'news_all'])->name('index.news_all');
    Route::get('/News_detail={id?}', [FrontendController::class, 'news_detail'])->name('index.news_detail');
    Route::get('/Courses/{name?}', [FrontendController::class, 'course_all'])->name('index.course_all');
    Route::get('/Courses_detail={id?}', [FrontendController::class, 'course_detail'])->name('index.course_detail');

    Route::get('/th/{name?}/detail/{id?}', [FrontendController::class, 'article_detail'])->name('index.article_detail');
    Route::get('/th/{name?}/{year?}/{month?}', [FrontendController::class, 'mode_articles_all'])->name('index.mode_articles_all');

    Route::get('/Content/Detail/{id?}', [FrontendController::class, 'document_detail'])->name('index.content_detail');
    Route::get('/Detail/{name?}/{id?}', [FrontendController::class, 'document_detail'])->name('index.document_detail');

    Route::get('/Statistics/{name?}', [FrontendController::class, 'statistics_detail'])->name('index.statistics_detail');
    // Route::get('/Statistics/{name?}/{year?}', [FrontendController::class, 'statistics_detail'])->name('index.statistics_detail');
    Route::get('/Report/category/{id?}', [FrontendController::class, 'report_detail'])->name('index.report_detail');

    Route::get('/Document_type={id?}', [FrontendController::class, 'document_all'])->name('index.document_all');
    Route::get('/Document_category={id?}', [FrontendController::class, 'document_category'])->name('index.document_category');
    Route::post('/search_document', [FrontendController::class, 'search_document'])->name('index.search_document');

    Route::post('/chart_data', [FrontendController::class, 'get_chart_data'])->name('get_chart_data');
    Route::get('/direct_line', [GuestController::class, 'direct_line_show'])->name('index.direct_line_show');
    Route::post('/direct_line_insert', [GuestController::class, 'direct_line_insert'])->name('index.direct_line_insert');
});


// Route::get('/', [GuestController::class, 'index1'])->name('index');

Route::get('/content_show', function () {
	return view('content');
});
Route::get('/board{id1?}&&{id2?}',[GuestController::class, 'board'])->name('index.board');
Route::get('/mode={mode?}&&id={id?}',[GuestController::class, 'content_show'])->name('index.content_show');
Route::get('/activity_show', [GuestController::class, 'activity_all'])->name('index.activity_all');
Route::get('/activity_detail={id?}', [GuestController::class, 'activity_detail'])->name('index.activity_detail');
Route::get('/news_show', [GuestController::class, 'news_all'])->name('index.news_all');
Route::get('/news_detail={id?}', [GuestController::class, 'news_detail'])->name('index.news_detail');
Route::get('/quality_detail={id?}&&year={year?}', [GuestController::class, 'quality_detail'])->name('index.quality_detail');

Route::get('/detail={id?}',[GuestController::class, 'content_detail'])->name('index.content_detail');

Route::get('/company_all',[GuestController::class, 'company_all'])->name('index.company_all');
Route::get('/company_year',[GuestController::class, 'company_year'])->name('index.company_year');
Route::get('/document_all{id?}',[GuestController::class, 'document_all'])->name('index.document_all');
Route::get('/document_category={id?}',[GuestController::class, 'document_category'])->name('index.document_category');
Route::post('/seach_document',[GuestController::class, 'seach_document'])->name('index.seach_document');

Route::get('document_all/fetch_data', [GuestController::class, 'fetch_data'])->name('index.fetch_document_all');
// --------------------------------------------------------



// Route::get('/admin', function () {
// 	return view('admin.index');
// });
// Route::get('/people', function () {
// 	return view('admin.peopleAll');
// });
// Route::get('/company', function () {
// 	return view('admin.company');
// });
Route::get('/activity', function () {
	return view('admin.activity');
});
Route::get('/news', function () {
	return view('admin.news');
});
Route::get('/calender_activity', function () {
	return view('admin.calender_activity');
});
// Route::get('/setting_menu', function () {
// 	return view('admin.setting_menu');
// });
// Route::get('/member', function () {
// 	return view('admin.member');
// });
// Route::get('/setting_content', function () {
// 	return view('admin.setting_content');
// });



Route::get('/login',[Controller::class, 'login'])->name('login');
Route::post('/loginpostback',[Controller::class, 'loginpostback'])->name('loginpostback');
Route::get('/logout',[Controller::class, 'logout'])->name('logout');
Route::get('/logoutpostback',[Controller::class, 'logoutpostback'])->name('logoutpostback');
Route::get('/admin/show',[Controller::class, 'admin'])->name('admin');


Route::get('/content_edit/{id1?}&&{id2?}&&{mode?}',[ContentController::class, 'edit_detail_menu'])->name('content.edit');
Route::get('/content/{id?}&&{mode?}',[ContentController::class, 'index'])->name('content.index');
Route::post('/content/insert',[ContentController::class, 'insert_detail_menu'])->name('content.insert_index');
Route::get('/content_delete/{id?}',[ContentController::class, 'delete_detail_menu'])->name('content.delete_detail_menu');

Route::post('/people/insert',[ContentController::class, 'insert_people'])->name('content.insert_people');
Route::post('/people_edit/update',[ContentController::class, 'update_people'])->name('content.update_people');
Route::get('/people/{id?}',[ContentController::class, 'borad'])->name('content.borad');
Route::get('/people_edit/{id?}',[ContentController::class, 'edit_people'])->name('content.edit_people');
Route::get('/people_delete/{id?}',[ContentController::class, 'delete_people'])->name('content.delete_people');


Route::get('/setting_menu/test',[MenuController::class, 'showSearchName'])->name('menu.test');

Route::post('/setting_menu/setting_update',[MenuController::class, 'setting_update'])->name('menu.setting_update');
Route::get('/setting_menu/show',[MenuController::class, 'index'])->name('menu.index');
Route::get('/setting_menu/{id?}',[MenuController::class, 'edit'])->name('menu.edit');
Route::post('/setting_menu/main',[MenuController::class, 'main'])->name('menu.main');
Route::post('/setting_menu/main_update',[MenuController::class, 'main_update'])->name('menu.main_update');

Route::post('/setting_menu/sub',[MenuController::class, 'sub'])->name('menu.sub');
Route::get('/setting_menu/sub{id?}',[MenuController::class, 'sub_edit'])->name('menu.sub_edit');


Route::get('/setting_people/show',[PeopleController::class, 'index'])->name('people.index');
Route::post('/setting_people/group',[PeopleController::class, 'group'])->name('people.group');
Route::post('/setting_people/people_update',[PeopleController::class, 'people_update'])->name('people.group_update');
Route::post('/setting_people/setting_update',[PeopleController::class, 'setting_update'])->name('people.setting_update');
Route::get('/setting_people/{id}',[PeopleController::class, 'edit'])->name('people.edit');


Route::get('/setting_document/s',[DocumentController::class, 'setting_all'])->name('setting_documents.index');
Route::get('/setting_document/{id?}&&{year?}',[DocumentController::class, 'setting_all'])->name('setting_document.index');
Route::post('/dynamic_year/fetch',[DocumentController::class, 'fetch_year'])->name('dynamic_year.fetch');
Route::post('/dynamic_type/fetch',[DocumentController::class, 'fetch_type_document'])->name('dynamic_type.fetch');
Route::post('/dynamic_category/fetch',[DocumentController::class, 'fetch_category_document'])->name('dynamic_category.fetch');
Route::post('/dynamic_title/fetch',[DocumentController::class, 'fetch_title_document'])->name('dynamic_title.fetch');
Route::post('/dynamic_sub_title/fetch',[DocumentController::class, 'fetch_sub_title_document'])->name('dynamic_sub_title.fetch');
Route::post('/dynamic_data/fetch',[DocumentController::class, 'fetch_dataAll_document'])->name('dynamic_data.fetch');

Route::post('/year/insert',[DocumentController::class, 'year_insert'])->name('document.insert_year');
Route::post('/type_document/insert',[DocumentController::class, 'type_document_insert'])->name('type_document.insert');
Route::post('/Category_document/insert',[DocumentController::class, 'category_document_insert'])->name('category_document.insert');
Route::post('/title_document/insert',[DocumentController::class, 'title_document_insert'])->name('title_document.insert');
Route::post('/sub_title_document/insert',[DocumentController::class, 'sub_title_document_insert'])->name('sub_title_document.insert');

Route::get('/type_document_delete/{id?}',[DocumentController::class, 'type_document_delete'])->name('type_document.delete');
Route::get('/category_document_delete/{id?}',[DocumentController::class, 'category_document_delete'])->name('category_document.delete');
Route::get('/title_document_delete/{id?}',[DocumentController::class, 'title_document_delete'])->name('title_document.delete');
Route::get('/sub_title_document_delete/{id?}',[DocumentController::class, 'sub_title_document_delete'])->name('sub_title_document.delete');



Route::post('/position/insert',[PeopleController::class, 'insert_position'])->name('people.insert_position');

Route::get('/member/show',[MemberController::class, 'index'])->name('member.index');
Route::post('/member/insert',[MemberController::class, 'insert'])->name('member.insert');
Route::get('/member/{id?}',[MemberController::class, 'delete'])->name('member.delete');

Route::get('/company',[CompanyController::class, 'index'])->name('company.index');
Route::post('/company/insert',[CompanyController::class, 'company_insert'])->name('company.insert');
Route::post('/company/update',[CompanyController::class, 'company_update'])->name('company.update');
Route::get('/company/{id?}',[CompanyController::class, 'edit'])->name('company.edit');

Route::get('/product/{id?}',[CompanyController::class, 'product'])->name('product.show');
Route::post('/product/insert',[CompanyController::class, 'product_insert'])->name('product.insert');
Route::get('/product_delete/{id?}',[CompanyController::class, 'delete_product'])->name('product.delete');

Route::get('/document/s',[DocumentController::class, 'index'])->name('document.index');
Route::get('/quality/s',[DocumentController::class, 'quality_index'])->name('quality.index');
Route::post('/document/insert',[DocumentController::class, 'document_insert'])->name('document.insert');
Route::post('/document/update',[DocumentController::class, 'document_update'])->name('document.update');
Route::get('/document/{id?}',[DocumentController::class, 'edit'])->name('document.edit');
Route::get('/quality/{id?}',[DocumentController::class, 'quality_edit'])->name('quality.edit');
Route::get('/document_delete/{id?}',[DocumentController::class, 'delete_document'])->name('document.delete');

Route::post('/dynamic_category/fetch',[DocumentController::class, 'fetch_category_document'])->name('dynamic_category.fetch');
Route::post('/dynamic_title/fetch',[DocumentController::class, 'fetch_title_document'])->name('dynamic_title.fetch');
Route::post('/title_document/insert',[DocumentController::class, 'title_document_insert'])->name('title_document.insert');

Route::get('/sent_office',[DocumentController::class, 'sent_office'])->name('sent_office.index');
Route::post('/sent_office/insert',[DocumentController::class, 'sent_office_insert'])->name('sent_office.insert');
Route::post('/sent_office/update',[DocumentController::class, 'sent_office_update'])->name('sent_office.update');
Route::get('/sent_office_delete/{id?}',[DocumentController::class, 'delete_sent_office'])->name('sent_office.delete');

Route::get('/sub_document/{id?}',[DocumentController::class, 'sub_document'])->name('sub_document.show');
Route::post('/sub_document/insert',[DocumentController::class, 'sub_document_insert'])->name('sub_document.insert');
Route::get('/sub_document_delete/{id?}',[DocumentController::class, 'delete_sub_document'])->name('sub_document.delete');

Route::get('/setting_content/show',[TemplateController::class, 'set_content'])->name('template.set');
Route::post('/setting_content/insert',[TemplateController::class, 'set_insert'])->name('template.set_insert');

Route::get('/setting_index/show',[ContentController::class, 'setting_index'])->name('setting.index');
Route::post('/setting_index/insert',[ContentController::class, 'set_index_insert'])->name('setting.index_insert');

Route::get('/setting_index_top/show',[ContentController::class, 'setting_index_top'])->name('setting.index_top');
Route::get('/setting_index_top_update/{id?}',[ContentController::class, 'update_index_top'])->name('setting_index_top.update');
Route::get('/setting_index_top_delete/{id?}',[ContentController::class, 'delete_index_top'])->name('setting_index_top.delete');

Route::get('/reference_naga/show',[Document2Controller::class, 'reference_naga'])->name('reference_naga.show');
Route::post('/reference_naga/insert',[Document2Controller::class, 'reference_naga_insert'])->name('reference_naga.insert');
Route::get('/reference_naga/{id?}',[Document2Controller::class, 'delete_reference_naga'])->name('reference_naga.delete');

Route::get('/document_rdi/{id?}',[Document2Controller::class, 'document_rdi'])->name('document_rdi.show');
Route::post('/document_rdi/insert',[Document2Controller::class, 'document_rdi_insert'])->name('document_rdi.insert');
Route::get('/document_rdi_delete/{id?}',[Document2Controller::class, 'delete_document_rdi'])->name('document_rdi.delete');

Route::get('/e_gp_running/show',[Document2Controller::class, 'running'])->name('running.show');
Route::post('/e_gp_running/insert',[Document2Controller::class, 'running_insert'])->name('running.insert');
Route::get('/e_gp_running_delete/{id?}',[Document2Controller::class, 'delete_running'])->name('running.delete');

Route::get('/nriis',[nriisController::class, 'proposal'])->name('nriis.index');



// Route::get('/{link?}',[Controller::class, 'login');
