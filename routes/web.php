<?php

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



// Route::get('/', function () {
// 	return view('test');
// });
Route::get('/', 'GuestController@index1');


// Route::get('/activity_detail', function () {
//     return view('activity_detail');
// });
// Route::get('/activity_show', function () {
// 	return view('activity_show');
// });
Route::get('/content_show', function () {
	return view('content');
});
Route::get('/board{id1?}&&{id2?}','GuestController@board')->name('index.board');
Route::get('/mode={mode?}&&id={id?}','GuestController@content_show')->name('index.content_show');
Route::get('/activity_show', 'GuestController@activity_all')->name('index.activity_all');
Route::get('/activity_detail={id?}', 'GuestController@activity_detail')->name('index.activity_detail');
Route::get('/news_show', 'GuestController@news_all')->name('index.news_all');
Route::get('/news_detail={id?}', 'GuestController@news_detail')->name('index.news_detail');
Route::get('/quality_detail={id?}&&year={year?}', 'GuestController@quality_detail')->name('index.quality_detail');

Route::get('/detail={id?}','GuestController@content_detail')->name('index.content_detail');

Route::get('/company_all','GuestController@company_all')->name('index.company_all');
Route::get('/company_year','GuestController@company_year')->name('index.company_year');
Route::get('/document_all{id?}','GuestController@document_all')->name('index.document_all');
Route::get('/document_category={id?}','GuestController@document_category')->name('index.document_category');
Route::post('/seach_document','GuestController@seach_document')->name('index.seach_document');

Route::get('document_all/fetch_data', 'GuestController@fetch_data')->name('index.fetch_document_all');
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



Route::get('/login','Controller@login')->name('login');
Route::post('/loginpostback','Controller@loginpostback')->name('loginpostback');
Route::get('/logout','Controller@logout')->name('logout');
Route::get('/logoutpostback','Controller@logoutpostback')->name('logoutpostback');
Route::get('/admin/show','Controller@admin')->name('admin');


Route::get('/content_edit/{id1?}&&{id2?}&&{mode?}','ContentController@edit_detail_menu')->name('content.edit');
Route::get('/content/{id?}&&{mode?}','ContentController@index')->name('content.index');
Route::post('/content/insert','ContentController@insert_detail_menu')->name('content.insert_index');
Route::get('/content_delete/{id?}','ContentController@delete_detail_menu')->name('content.delete_detail_menu');

Route::post('/people/insert','ContentController@insert_people')->name('content.insert_people');
Route::post('/people_edit/update','ContentController@update_people')->name('content.update_people');
Route::get('/people/{id?}','ContentController@borad')->name('content.borad');
Route::get('/people_edit/{id?}','ContentController@edit_people')->name('content.edit_people');
Route::get('/people_delete/{id?}','ContentController@delete_people')->name('content.delete_people');


Route::get('/setting_menu/test','MenuController@showSearchName')->name('menu.test');

Route::post('/setting_menu/setting_update','MenuController@setting_update')->name('menu.setting_update');
Route::get('/setting_menu/show','MenuController@index')->name('menu.index');
Route::get('/setting_menu/{id?}','MenuController@edit')->name('menu.edit');
Route::post('/setting_menu/main','MenuController@main')->name('menu.main');
Route::post('/setting_menu/main_update','MenuController@main_update')->name('menu.main_update');

Route::post('/setting_menu/sub','MenuController@sub')->name('menu.sub');
Route::get('/setting_menu/sub{id?}','MenuController@sub_edit')->name('menu.sub_edit');


Route::get('/setting_people/show','PeopleController@index')->name('people.index');
Route::post('/setting_people/group','PeopleController@group')->name('people.group');
Route::post('/setting_people/people_update','PeopleController@people_update')->name('people.group_update');
Route::post('/setting_people/setting_update','PeopleController@setting_update')->name('people.setting_update');
Route::get('/setting_people/{id}','PeopleController@edit')->name('people.edit');


Route::get('/setting_document/s','DocumentController@setting_all')->name('setting_documents.index');
Route::get('/setting_document/{id?}&&{year?}','DocumentController@setting_all')->name('setting_document.index');
Route::post('/dynamic_year/fetch','DocumentController@fetch_year')->name('dynamic_year.fetch');
Route::post('/dynamic_type/fetch','DocumentController@fetch_type_document')->name('dynamic_type.fetch');
Route::post('/dynamic_category/fetch','DocumentController@fetch_category_document')->name('dynamic_category.fetch');
Route::post('/dynamic_title/fetch','DocumentController@fetch_title_document')->name('dynamic_title.fetch');
Route::post('/dynamic_sub_title/fetch','DocumentController@fetch_sub_title_document')->name('dynamic_sub_title.fetch');
Route::post('/dynamic_data/fetch','DocumentController@fetch_dataAll_document')->name('dynamic_data.fetch');

Route::post('/year/insert','DocumentController@year_insert')->name('document.insert_year');
Route::post('/type_document/insert','DocumentController@type_document_insert')->name('type_document.insert');
Route::post('/Category_document/insert','DocumentController@category_document_insert')->name('category_document.insert');
Route::post('/title_document/insert','DocumentController@title_document_insert')->name('title_document.insert');
Route::post('/sub_title_document/insert','DocumentController@sub_title_document_insert')->name('sub_title_document.insert');

Route::get('/type_document_delete/{id?}','DocumentController@type_document_delete')->name('type_document.delete');
Route::get('/category_document_delete/{id?}','DocumentController@category_document_delete')->name('category_document.delete');
Route::get('/title_document_delete/{id?}','DocumentController@title_document_delete')->name('title_document.delete');
Route::get('/sub_title_document_delete/{id?}','DocumentController@sub_title_document_delete')->name('sub_title_document.delete');



Route::post('/position/insert','PeopleController@insert_position')->name('people.insert_position');

Route::get('/member/show','MemberController@index')->name('member.index');
Route::post('/member/insert','MemberController@insert')->name('member.insert');
Route::get('/member/{id?}','MemberController@delete')->name('member.delete');

Route::get('/company','CompanyController@index')->name('company.index');
Route::post('/company/insert','CompanyController@company_insert')->name('company.insert');
Route::post('/company/update','CompanyController@company_update')->name('company.update');
Route::get('/company/{id?}','CompanyController@edit')->name('company.edit');

Route::get('/product/{id?}','CompanyController@product')->name('product.show');
Route::post('/product/insert','CompanyController@product_insert')->name('product.insert');
Route::get('/product_delete/{id?}','CompanyController@delete_product')->name('product.delete');

Route::get('/document/s','DocumentController@index')->name('document.index');
Route::get('/quality/s','DocumentController@quality_index')->name('quality.index');
Route::post('/document/insert','DocumentController@document_insert')->name('document.insert');
Route::post('/document/update','DocumentController@document_update')->name('document.update');
Route::get('/document/{id?}','DocumentController@edit')->name('document.edit');
Route::get('/quality/{id?}','DocumentController@quality_edit')->name('quality.edit');
Route::get('/document_delete/{id?}','DocumentController@delete_document')->name('document.delete');

Route::post('/dynamic_category/fetch','DocumentController@fetch_category_document')->name('dynamic_category.fetch');
Route::post('/dynamic_title/fetch','DocumentController@fetch_title_document')->name('dynamic_title.fetch');
Route::post('/title_document/insert','DocumentController@title_document_insert')->name('title_document.insert');

Route::get('/sent_office','DocumentController@sent_office')->name('sent_office.index');
Route::post('/sent_office/insert','DocumentController@sent_office_insert')->name('sent_office.insert');
Route::post('/sent_office/update','DocumentController@sent_office_update')->name('sent_office.update');
Route::get('/sent_office_delete/{id?}','DocumentController@delete_sent_office')->name('sent_office.delete');

Route::get('/sub_document/{id?}','DocumentController@sub_document')->name('sub_document.show');
Route::post('/sub_document/insert','DocumentController@sub_document_insert')->name('sub_document.insert');
Route::get('/sub_document_delete/{id?}','DocumentController@delete_sub_document')->name('sub_document.delete');

Route::get('/setting_content/show','TemplateController@set_content')->name('template.set');
Route::post('/setting_content/insert','TemplateController@set_insert')->name('template.set_insert');

Route::get('/setting_index/show','ContentController@setting_index')->name('setting.index');
Route::post('/setting_index/insert','ContentController@set_index_insert')->name('setting.index_insert');

Route::get('/setting_index_top/show','ContentController@setting_index_top')->name('setting.index_top');
Route::get('/setting_index_top_update/{id?}','ContentController@update_index_top')->name('setting_index_top.update');
Route::get('/setting_index_top_delete/{id?}','ContentController@delete_index_top')->name('setting_index_top.delete');

Route::get('/reference_naga/show','Document2Controller@reference_naga')->name('reference_naga.show');
Route::post('/reference_naga/insert','Document2Controller@reference_naga_insert')->name('reference_naga.insert');
Route::get('/reference_naga/{id?}','Document2Controller@delete_reference_naga')->name('reference_naga.delete');

Route::get('/document_rdi/{id?}','Document2Controller@document_rdi')->name('document_rdi.show');
Route::post('/document_rdi/insert','Document2Controller@document_rdi_insert')->name('document_rdi.insert');
Route::get('/document_rdi_delete/{id?}','Document2Controller@delete_document_rdi')->name('document_rdi.delete');

Route::get('/e_gp_running/show','Document2Controller@running')->name('running.show');
Route::post('/e_gp_running/insert','Document2Controller@running_insert')->name('running.insert');
Route::get('/e_gp_running_delete/{id?}','Document2Controller@delete_running')->name('running.delete');

Route::get('/nriis','nriisController@proposal')->name('nriis.index');



// Route::get('/{link?}','Controller@login');