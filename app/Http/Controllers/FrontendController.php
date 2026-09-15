<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\banner;
use App\Models\borad;
use App\Models\category_document;
use App\Models\course;
use App\Models\detail_menu;
use App\Models\detail_menu_array;
use App\Models\document;
use App\Models\group_people;
use App\Models\main_menu;
use App\Models\mode_article;
use App\Models\people;
use App\Models\sub_document;
use App\Models\sub_menu;
use App\Models\sub_title_document;
use App\Models\title_document;
use App\Models\type_document;
use App\Models\year;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {

        // -------------------------------
        // init ค่าเริ่มต้น
        // -------------------------------
        $document = collect();
        $banner_top = collect();
        $md = null;
        $event_cut = collect();

        // -------------------------------
        // calendar
        // -------------------------------
        // $calendar = $this->dc->get_calendar_object(12);
        // $event_cut = $calendar ? $calendar->events(6) : collect();

        // -------------------------------
        // ผู้บริหาร
        // -------------------------------
        $md = people::where('position_id', 1)->first() ?? people::where('position_id', 32)->first();

        // -------------------------------
        // ดึง category แบบปลอดภัย
        // -------------------------------
        $getDocsByCategory = function ($name, $limit = 10) {
            $category = category_document::where('name', $name)->first();
            return $category
                ? Document::where('category_document_id', $category->id)
                    ->latest()
                    ->limit($limit)
                    ->get()
                : collect();
        };

        $ทุนวิจัย = $getDocsByCategory('ประกาศรับทุนวิจัย');
        $ผลทุน   = $getDocsByCategory('ประกาศผลทุน');
        $ข่าว    = $getDocsByCategory('ข่าว');

        // -------------------------------
        // document + banner
        // -------------------------------
        $document = Document::latest()->limit(4)->get();

        $banner_top = Banner::where('place', 'top')
            ->where('status_show', 1)
            ->orderBy('ordinal')
            ->limit(10)
            ->get();

        // -------------------------------
        // กิจกรรม (sub menu)
        // -------------------------------
        $subMenu = Sub_menu::where('name', 'กิจกรรม')->latest()->first();

        $activities = $subMenu
            ? Detail_menu::where('sub_menu_id', $subMenu->id)
                ->orderBy('start_date', 'desc')
                ->limit(6)
                ->get()
            : collect();

        // -------------------------------
        // รวม data แบบ index()
        // -------------------------------
        $data = $this->showMenu();

        $data['md'] = $md;
        $data['banner_top'] = $banner_top;
        $data['event_cut'] = $event_cut;

        // แยกแบบเดิม
        $data['data_detail_menu1'] = $ทุนวิจัย;
        $data['data_detail_menu2'] = $ผลทุน;
        $data['data_detail_menu3'] = $ข่าว;
        $data['data_detail_menu4'] = $activities;

        // -------------------------------
        // รวมเป็น articles (เหมือน index ใหม่)
        // -------------------------------
        $data['articles'] = [
            'all' => collect()
                ->merge($ทุนวิจัย)
                ->merge($ผลทุน)
                ->merge($ข่าว)
                ->merge($activities)
                ->sortByDesc('created_at')
                ->take(10),

            'research' => $ทุนวิจัย,
            'result'   => $ผลทุน,
            'news'     => $ข่าว,
            'activity' => $activities,
        ];

        // -------------------------------
        // tab links
        // -------------------------------
        $data['tab_links'] = [
            'all'      => route('index'),
            'research' => route('index', ['name' => 'research']),
            'result'   => route('index', ['name' => 'result']),
            'news'     => route('index', ['name' => 'news']),
            'activity' => route('index', ['name' => 'activity']),
        ];

        return view('Frontend.index', $data);
    }

    public function content_show($mode = '', $id = '')
    {
        $menu = [];
        $data_detail_menu = [];
        $data_company = [];
        $data_product = [];
        $data_document = [];
        $data_sub_document = [];
        $page_blade = 'Frontend.content';
        if ($mode == 'main') {
            $menu = Main_menu::find($id);
            $data_detail_menu = Detail_menu::where('main_menu_id', $id)->orderBy('number_show', 'asc')->get();
            $a = 'main';
        } elseif ($mode == 'sub') {
            $menu = Sub_menu::find($id);
            $data_detail_menu = Detail_menu::where('sub_menu_id', $id)->orderBy('number_show', 'asc')->get();
            $a = 'sub';
        } elseif ($mode == 'company') {
            $data_company = Company::where('id', $id)->first();
            $a = 'company';
            $data_product = Product::where('company_id', $id)->get();
        } elseif ($mode == 'document') {
            $data_document = Document::where('id', $id)->first();
            $a = 'document';
            $data_sub_documents = Sub_document::where('document_id', $id)->get();
        }
        if (! empty($data_sub_documents)) {
            $i = 0;
            foreach ($data_sub_documents as $row) {
                $data_sub_document[$i] = $row;
                if (! empty($row->file)) {
                    $FileType = substr($row->file, -3);
                    $data_sub_document[$i]->filetype = $FileType;
                }
                $i++;
            }
        }
        $data = $this->showMenu();
        $data['menu'] = $menu;
        $data['data_sub_document'] = $data_sub_document;
        $data['data_detail_menu'] = $data_detail_menu;
        $data['data_company'] = $data_company;
        $data['data_product'] = $data_product;
        $data['data_document'] = $data_document;

        $data['mode'] = $a;

        //        dd($data);
        return view($page_blade, $data);

    }

    public function content_detail($id = '')
    {
        $data_detail_menu = [];
        $check_gallry = [];
        $data_array = [];
        $data_detail_menu = Detail_menu::find($id);

        if (! empty($data_detail_menu->file)) {
            $FileType = substr($data_detail_menu->file, -3);
            $data_detail_menu->filetype = $FileType;
        }

        $check_gallry = Detail_menu_array::where('detail_menu_id', $id)->get();
        if (! empty($check_gallry)) {
            $data_array = $check_gallry;
        }

        $data = $this->showMenu();
        $data['data_detail_menu'] = $data_detail_menu;
        $data['data_array'] = $data_array;

        // return dd($data);
        return view('content_detail', $data);

    }

    public function activity_all()
    {
        // 21
        $a = 'กิจกรรม';
        $calendar = $this->dc->get_calendar_object(env('NSRU_CALENDER'));
        $event_cut = $calendar->events(12);

        $data = $this->showMenu();
        $data['event_all'] = $event_cut;
        $data['mode'] = $a;

        return view('Frontend.activity', $data);
    }

    public function activity_detail($id = '')
    {
        $a = 'กิจกรรม';
        $calendar = $this->dc-->get_calendar_object(env('NSRU_CALENDER'));
        $event_cut = $calendar->events(7);

        $gallery = new \NSRU\Event($this->dc);
        $gallery->load($id);
        $gallery_cut = $gallery->get_images();
        // $gallery_p = $gallery_cut->paginate(16);

        $data = $this->showMenu();
        $data['event_all'] = $event_cut;
        $data['event_cut'] = $gallery;
        $data['gallery_cut'] = $gallery_cut;
        $data['mode'] = $a;

        return view('Frontend.activity_detail', $data);
    }

    public function news_all()
    {
        $a = 'ข่าวประชาสัมพันธ์';
        $newpaper = $this->dc->get_newspaper_object(env('NSRU_NEWSPAPER'));
        $news_cut = $newpaper->news(12);

        $sub_menu = Sub_menu::where('name', $a)->first();

        $data = $this->showMenu();
        $data['news_all'] = $news_cut;
        $data['mode'] = $sub_menu;

        //    dd($data);
        return view('Frontend.activity', $data);
    }

    public function news_detail($id = '')
    {
        $a = 'ข่าวประชาสัมพันธ์';
        $news_cut = new \NSRU\News($this->dc);

        $news_cut->load($id);
        $data = $this->showMenu();
        $data['news_cut'] = $news_cut;
        $data['mode'] = $a;

        return view('Frontend.activity_detail', $data);
    }

    public function course_all($name = '')
    {
        $a = 'หลักสูตรทั้งหมด';
        $i = 0;
        $mode = '';
        $document = [];
        if (! empty($name)) {
            $mode = Type_document::Where('name', $name)->first();
            $a = $a.$mode->name;
            // $category = Category_document::Where('type_document_id', $mode->id)->orderBy('ordinal', 'asc')->where('status_use', 1)->get();
            $document = course::where('type_document_id',$mode->id)->where('lang',session('lang') ?? 'th')->get();
            // if (! empty($category[0])) {
            //     foreach ($category as $row) {
            //         $document[$i] = $row;
            //         $document[$i]->course = course::Where('type_document_id', $mode->id)->where('category_document_id', $row->id)->get();
            //         $i++;
            //     }
            // }
        }else{
            $name = $a;
            $document = course::where('lang',session('lang') ?? 'th')->get();
        }
        $sub_menu = Sub_menu::where('name', $name)->first();

        $course_time_all = TagModel::where('content','course_time')->get();
        $course_type_all = TagModel::where('content','course_type')->get();
        $mode_all = Type_document::where('mode', 'course')->get();
        $data = $this->showMenu();

        $data['course_time_all'] = $course_time_all;
        $data['course_type_all'] = $course_type_all;
        $data['course_all'] = $document;
        $data['mode_all'] = $mode_all;
        $data['mode'] = $sub_menu ?? $a;

        //  dd($sub_menu, $name , $a);
        return view('Frontend.activity', $data);
    }

    public function course_filter(Request $request)
    {
        $lang = session('lang') ?? 'th';

        // เริ่มต้น Query
        $query = course::query()->where('lang', $lang);

        // ----------------------------------------------------
        // 1. กรอง ระดับปริญญา (Degree)
        // ตรงกับ Model: belongsTo(type_document::class, 'type_document_id')
        // ----------------------------------------------------
        if ($request->has('mode') && is_array($request->mode) && count($request->mode) > 0) {
            $query->whereIn('type_document_id', $request->mode);
        }

        // ----------------------------------------------------
        // 2. กรอง หมวดหมู่ (Type) -> แก้ให้เช็คผ่าน Tags
        // (เพราะ data-group="type" คือ Tags)
        // ----------------------------------------------------
        if ($request->has('type') && is_array($request->type) && count($request->type) > 0) {

            // ใช้ whereHas เพื่อเข้าไปเช็คในตาราง Tags ผ่าน Relationship
            $query->whereHas('tags', function($q) use ($request) {
                // เช็คว่า id ของ tag ตรงกับที่เลือกมาไหม
                $q->whereIn('tags.id', $request->type);
            });

        }

        // ----------------------------------------------------
        // 3. กรอง วัน-เวลาเรียน (Time)
        // ** แก้ไขให้ตรงกับ Model course.php แล้ว **
        // ----------------------------------------------------
        if ($request->has('time') && is_array($request->time) && count($request->time) > 0) {
            // ใช้ชื่อจาก Model ที่คุณส่งมา
            $query->whereIn('date_schedule_study_id', $request->time);
        }

        // ----------------------------------------------------
        // 4. กรอง อื่นๆ (New / MBA)
        // ----------------------------------------------------
        if ($request->has('others') && is_array($request->others)) {
            $others = $request->others;

            // NEW: เรียงลำดับจากใหม่ไปเก่า
            if (in_array('new', $others)) {
                $query->orderBy('created_at', 'desc');
            }

            // MBA: ค้นหาคำว่า MBA ในชื่อหลักสูตร (ถ้าไม่มี Column is_mba)
            if (in_array('mba', $others)) {
                $query->where('title', 'LIKE', '%MBA%');
            }
        }

        // ----------------------------------------------------
        // ดึงข้อมูลและส่งกลับ
        // ----------------------------------------------------
        $courses = $query->get();

        $html = view('Frontend.course_cards', [
            'course_all' => $courses,
        ])->render();

        return response()->json([
            'html' => $html,
            'count' => $courses->count(),
        ]);
    }

    public function course_detail($id = '')
    {
        //        $a = 'หลักสูตร';
        $course_cut = course::Where('id', $id)->first();
        $mode = $course_cut->courses_name ?? $course_cut->title;
        $join_database_id = $course_cut->type_document->name ?? null;
        $menu = main_menu::where('join_database', 'index.course_all')->where('join_database_id', (string) $join_database_id)->first();
        if (empty($menu)) {
            $menu = sub_menu::where('join_database', 'index.course_all')->where('join_database_id', (string) $join_database_id)->first();
        }
        $data = $this->showMenu();
        $data['course_cut'] = $course_cut;
        $data['mode'] = $mode ?? null;
        $data['menu'] = $menu ?? null;
// dd($data, $join_database_id);
        return view('Frontend.activity_detail', $data);
    }

    public function mode_articles_all($name = '', $year = '', $month = '')
    {
            $mode = mode_article::Where('name_eng', $name)->first();

            // Default: ถ้าไม่มีปี/เดือนใน URL ให้ใช้เดือนปัจจุบัน
            if (empty($year)) {
                $year = date('Y');
            }
            if (empty($month)) {
                $month = date('m');
            }

            // ดึงข้อมูลสำหรับปฏิทิน Widget (ดึงทั้งหมด หรือเฉพาะช่วง ก็ได้)
            $mode_article_calender = mode_article::Where('name_eng', 'calender')->first();
            $calenders = article::where('mode_article_id', $mode_article_calender->id)
                ->orderBy('date_start', 'asc')
                ->get();

            // ดึงข้อมูลรายการกิจกรรม (List ด้านขวา) กรองตามเดือน/ปี ที่เลือก
            if ($name == 'calender') {

                // 1. สร้าง Query เตรียมไว้ก่อน (ยังไม่ get/paginate)
                $query = article::where('mode_article_id', $mode->id)
                    ->whereYear('date_start', (int) $year)
                    ->whereMonth('date_start', (int) $month);

                // 2. [เพิ่มใหม่] เช็คว่า URL มีค่า ?day=... ส่งมาไหม (เช่น คลิกวันที่ 5)
                if (request()->has('day') && ! empty(request('day'))) {
                    $query->whereDay('date_start', (int) request('day'));
                }

                // 3. สั่งเรียงลำดับและดึงข้อมูล
                $articles = $query->orderBy('date_start', 'asc')
                    ->paginate(9);
            } else {
                // กรณีไม่ใช่หน้าปฏิทิน (แสดงกิจกรรมทั้งหมด เรียงจากล่าสุด)
                $articles = article::where('mode_article_id', $mode->id)
                    ->orderBy('date_start', 'desc')
                    ->paginate(9);
            }
            $article_tag_all = TagModel::where('content','article')->get();

            $data = $this->showMenu();
            $data['mode'] = $mode;
            $data['articles'] = $articles;
            $data['calenders'] = $calenders;
            $data['article_tag_all'] = $article_tag_all;
            // ** สำคัญ: ส่งตัวแปรปีและเดือนปัจจุบันไปหน้า View **
            $data['current_year'] = (int) $year;
            $data['current_month'] = (int) $month;

            return view('Frontend.activity', $data);
    }

    public function article_filter(Request $request)
    {
        // 1. เริ่ม Query จาก Mode ID (เช่น กิจกรรม, ข่าวประชาสัมพันธ์)
        $query = article::query();

        if ($request->has('mode_id') && !empty($request->mode_id)) {
            $query->where('mode_article_id', $request->mode_id);
        }

        // ---------------------------------------------------------
        // 2. [สำคัญ] เพิ่ม Logic กรองตาม ปี/เดือน/วัน (เลียนแบบ mode_articles_all)
        // ---------------------------------------------------------

        // กรองปี
        if ($request->has('year') && !empty($request->year)) {
            $query->whereYear('date_start', (int) $request->year);
        }

        // กรองเดือน
        if ($request->has('month') && !empty($request->month)) {
            $query->whereMonth('date_start', (int) $request->month);
        }

        // กรองวัน (กรณีคลิกเลือกวันที่ในปฏิทิน)
        if ($request->has('day') && !empty($request->day)) {
            $query->whereDay('date_start', (int) $request->day);
        }

        // ---------------------------------------------------------
        // 3. กรองตาม Tags (ส่วนที่เพิ่มใหม่)
        // ---------------------------------------------------------
        if ($request->has('tag') && is_array($request->tag) && count($request->tag) > 0) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->whereIn('tags.id', $request->tag);
            });
        }

        // 4. เรียงลำดับและดึงข้อมูล (ใช้ Partial View)
        $articles = $query->orderBy('date_start', 'asc')->paginate(9); // ปฏิทินเรียง asc ตามที่คุณทำไว้

        // Render เฉพาะก้อน HTML ของบทความ
        $html = view('Frontend.article_list', [
            'articles' => $articles
        ])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function article_detail($name = '', $id = '')
    {
        $mode = mode_article::Where('name_eng', $name)->first();
        $article = article::find($id);
        $data = $this->showMenu();
        $data['mode'] = $mode;
        $data['article'] = $article;

        return view('Frontend.activity_detail', $data);
    }

    public function document_all1($id = '')
    {
        $i = 0;
        $category = [];
        $document = [];
        $year = [];
        $type = [];

        $type = Type_document::all();

        if (! empty($id)) {
            $data_type = Type_document::Where('id', $id)->first();
            $mode = Type_document::Where('id', $id)->first()->name;

            $category = Category_document::Where('type_document_id', $id)->orderBy('ordinal', 'asc')->get();
            if (! empty($category[0])) {
                foreach ($category as $row) {
                    $document[$i] = $row;
                    $title = Title_document::Where('type_document_id', $id)->where('category_document_id', $row->id)->orderBy('ordinal', 'asc')->get();

                    if (! empty($title[0])) {
                        $document[$i]->title = $title;
                        $doc = [];
                        $ii = 0;
                        foreach ($document[$i]->title as $row1) {
                            $doc[$ii] = $row1;
                            $doc[$ii]->document = Document::Where('type_document_id', $id)->where('category_document_id', $row->id)->where('title_document_id', $row1->id)->orderBy('ordinal', 'desc')->get();
                            $j = 0;
                            $data_doc = [];
                            foreach ($doc[$ii]->document as $sub_doc) {
                                $data_doc[$j] = $sub_doc;
                                $data_doc[$j]->detail_doc = Sub_document::Where('document_id', $sub_doc->id)->get();
                                $j++;
                            }
                            $ii++;
                        }
                    } else {
                        $document[$i]->document = Document::Where('type_document_id', $id)->where('category_document_id', $row->id)->orderBy('ordinal', 'desc')->get();
                    }
                    $i++;
                }
            } else {
                $document = Document::Where('type_document_id', $id)->orderBy('id', 'desc')->get();
            }

        } elseif ($id == 0) {
            //            $document = Document::all();
            $year = year::orderBy('year', 'asc')->get();
            $type = type_document::where('mode', 'document')->get();
            $mode = 'เอกสารทั้งหมด';
        }

        $data = $this->showMenu();
        $data['document_mode'] = $mode;
        $data['document_all'] = $document;
        $data['year'] = $year;
        $data['type'] = $type;
        $data['data_type'] = $data_type;

        $page = 'Frontend.document2';
        //        if(!empty($id) && $id == 2){
        //            $page = 'Frontend.content2';
        //        }
        //
        //        if(!empty($id) && $id == 4){
        //            $page = 'Frontend.content3';
        //        }

        //        dd($data);

        return view($page, $data);
    }

    public function document_all($id = '')
    {
        $i = 0;
        $category = [];
        $document = [];
        $year = [];
        $type = [];

        $type = Type_document::all();

        if (! empty($id)) {
            $data_type = Type_document::Where('id', $id)->first();
            $mode = (! empty($data_type) ? $data_type->name : '');

            if (! $data_type) {
                abort(404);
            }

            $menu = main_menu::where('join_database', 'index.document_all')->where('join_database_id', (string) $id)->first();
            if (empty($menu)) {
                $menu = sub_menu::where('join_database', 'index.document_all')->where('join_database_id', (string) $id)->first();
            }

            $category = Category_document::Where('type_document_id', $id)->orderBy('ordinal', 'asc')->get();
            if (! empty($category[0])) {
                foreach ($category as $row) {
                    $document[$i] = $row;
                    $title = Title_document::Where('type_document_id', $id)->where('category_document_id', $row->id)->orderBy('ordinal', 'asc')->get();

                    if (! empty($title[0])) {
                        $document[$i]->title = $title;
                        $doc = [];
                        $ii = 0;
                        foreach ($document[$i]->title as $row1) {
                            $doc[$ii] = $row1;
                            $doc[$ii]->document = Document::Where('type_document_id', $id)->where('category_document_id', $row->id)->where('title_document_id', $row1->id)->orderBy('ordinal', 'desc')->get();
                            $j = 0;
                            $data_doc = [];
                            foreach ($doc[$ii]->document as $sub_doc) {
                                $data_doc[$j] = $sub_doc;
                                $data_doc[$j]->detail_doc = Sub_document::Where('document_id', $sub_doc->id)->get();
                                $j++;
                            }
                            $ii++;
                        }
                    } else {
                        $document[$i]->document = Document::Where('type_document_id', $id)->where('category_document_id', $row->id)->orderBy('ordinal', 'desc')->get();
                    }
                    $i++;
                }
            } else {
                $document = Document::Where('type_document_id', $id)->orderBy('id', 'desc')->get();
            }

        } elseif ($id == 0) {
            //            $document = Document::all();
            $year = year::orderBy('year', 'asc')->get();
            $type = type_document::where('mode', 'document')->get();
            $mode = 'เอกสารทั้งหมด';
        }

        $data = $this->showMenu();
        $data['document_mode'] = $mode;
        $data['document_all'] = $document;
        $data['year'] = $year;
        $data['type'] = $type;
        $data['data_type'] = $data_type;
        $data['menu'] = $menu ?? null;
        $page = 'Frontend.document2';

        return view($page, $data);
    }

    public function document_category($id = '')
    {
        $i = 0;
        $year = [];
        $type = Type_document::all();

        if (! empty($id)) {

            $mode = Category_document::Where('id', $id)->first()->name;

            $title = Title_document::Where('category_document_id', $id)->orderBy('ordinal', 'asc')->get();
            if ($title->count() != 0) {
                foreach ($title as $row) {
                    $document[$i] = $row;

                    $sub_title = Sub_title_document::Where('title_document_id', $row->id)->orderBy('code', 'desc')->get();
                    $sub_doc = [];
                    $ii = 0;
                    if ($sub_title->count() != 0) {
                        $document[$i]->sub_title = $sub_title;
                        foreach ($document[$i]->sub_title as $row1) {
                            $j = 0;
                            $data_doc = [];
                            $sub_doc[$ii] = $row1;
                            $sub_doc[$ii]->sub_doc = Document::Where('sub_title_document_id', $row1->id)->orderBy('ordinal', 'desc')->get();
                            // foreach ($sub_doc[$i]->sub_doc as $sub_doc) {
                            //     $data_doc[$j] = $sub_doc;
                            //     $data_doc[$j]->detail_doc = Sub_document::Where('document_id',$sub_doc->id)->get();
                            //     $j++;
                            // }

                            $ii++;
                        }
                    }

                    $document[$i]->sub_doc = Document::Where('title_document_id', $row->id)->orderBy('ordinal', 'desc')->get();
                    $j = 0;
                    $data_doc = [];
                    foreach ($document[$i]->sub_doc as $sub_doc) {
                        $data_doc[$j] = $sub_doc;
                        $data_doc[$j]->detail_doc = Sub_document::Where('document_id', $sub_doc->id)->get();
                        $j++;
                    }
                    $i++;
                }
                $have = 1;
            } else {
                $have = 0;

                $document = Document::Where('category_document_id', $id)->orderBy('ordinal', 'desc')->get();
            }

        } elseif ($id == 0) {
            $document = Document::all();
            $mode = 'เอกสารทั้งหมด';
        }

        $data = $this->showMenu();
        $data['document_mode'] = $mode;
        $data['document_category'] = $document;
        $data['have'] = $have;

        // dd($data['document_category']);

        return view('Frontend.content', $data);
    }

    public function search_document(Request $request)
    {
        $type_document_id = $request->type_document_id;
        $category_document_id = $request->category_document_id;
        $name = $request->text_search;
        $search = [];
        $a = 'ค้นหาเอกสาร';
        $b = '';
        // dd($request->all());
        if (! empty($name)) {
            $b = $name;
            $search = Document::where('name', 'like', '%'.$name.'%');
            // dd($search->get());
            if (! empty($type_document_id)) {
                $search->where('type_document_id', $type_document_id);
            }

            if (! empty($category_document_id)) {
                $search->where('category_document_id', $category_document_id);
            }

        } else {
            if (! empty($type_document_id)) {
                $search = Document::where('type_document_id', $type_document_id);
            }

            if (! empty($category_document_id)) {
                $search->where('category_document_id', $category_document_id);
            }
        }

        $data = $this->showMenu();
        $data['mode'] = $a;
        $data['text_search'] = $b;
        $data['document_all'] = $search->get();

        //        dd($data);
        return view('Frontend.search_document', $data);
    }

    public function document_detail($mode = '', $id = '')
    {
        $year_last = '';
        $count_data = 0;
        $count_category = 0;
        $count_title = 0;
        $count_sub_title = 0;
        $data_type = [];
        $data_category = [];
        $data_title = [];
        $data_doc = [];
        $types = type_document::all();
        foreach ($types as $type) {
            $data_type[$count_data] = $type;
            $category = category_document::where('type_document_id', $type->id)->get();
            if (! empty($category[0])) {
                $data_type[$count_data]->category = $category;
                foreach ($data_type[$count_data]->category as $category) {
                    $data_category[$count_category] = $category;
                    $data_category[$count_category]->title = title_document::where('category_document_id', $category->id)->get();
                    foreach ($data_category[$count_category]->title as $title) {
                        $data_title[$count_title] = $title;
                        $data_title[$count_title]->sub_title = sub_title_document::where('title_document_id', $title->id)->get();
                        foreach ($data_title[$count_title]->sub_title as $sub_title) {
                            $data_doc[$count_sub_title] = $sub_title;
                            $data_doc[$count_sub_title]->document = document::where('sub_title_document_id', $sub_title->id)->get();
                            $count_sub_title++;
                        }
                        $count_title++;
                    }
                    $count_category++;
                }
            } else {
                $data_type[$count_data]->document = document::where('type_document_id', $type->id)->get();
            }

            $count_data++;
        }

        if (! empty($mode)) {
            $mode = type_document::where('id', $id)->first();
            $document = document::where('type_document_id', $id)->orderBy('id', 'desc')->first();
            $data_type = [];
        }
        $data = $this->showMenu();
        $data['year'] = $year_last;
        $data['document_all'] = $data_type;

        $data['menu'] = $mode;
        $data['document'] = $document;

        //         return dd($data);
        //        return view('Frontend.report', $data);
        return view('Frontend.document', $data);
    }

    public function board($id1 = '', $id2 = '')
    {
        $people1 = [];
        $people2 = [];
        $j1 = 0;
        $mode = borad::where('id', $id1)->first();

        $group1 = group_people::where('borad_id', $id1)->get();
        $borad = borad::where('id', $id1)->get();

        if (! empty($borad[0])) {
            foreach ($borad as $row) {
                $people1[$j1] = $row;
                $group1 = group_people::where('borad_id', $id1)->get();
                $people1[$j1]->group = $group1;
                if (! empty($group1[0])) {
                    $group1_people1 = [];
                    $gp1 = 0;
                    foreach ($people1[$j1]->group as $row1) {
                        $group1_people1[$gp1] = $row1;
                        $group1_people1[$gp1]->people = people::where('people.group_people_id', $row1->id)
                            ->join('positions', 'people.position_id', '=', 'positions.id')->orderBy('positions.ordinal', 'ASC')->select('people.*')->get();
                        $gp1++;
                    }
                }
                $people1[$j1]->people = People::where('people.borad_id', $row->id)
                    ->join('positions', 'people.position_id', '=', 'positions.id')->orderBy('positions.ordinal', 'ASC')->select('people.*')->get();
                $j1++;
            }
        }

        $menu_sub = sub_menu::where('join_database', 'index.board')->where('join_database_id', $id1)->first();

        $data = $this->showMenu();
        $data['menu'] = $menu_sub;
        $data['borad'] = $borad;
        $data['people1'] = $people1;
        $data['people2'] = $people2;

        return view('Frontend.borad', $data);
    }

    public function board2($id1 = '', $id2 = '')
    {
        $people1 = [];
        $people2 = [];
        $j1 = 0;
        $mode = borad::where('id', $id1)->first();

        $group1 = group_people::where('borad_id', $id1)->get();
        $borad = borad::where('id', $id1)->get();

        if (! empty($borad[0])) {
            foreach ($borad as $row) {
                $people1[$j1] = $row;
                $group1 = group_people::where('borad_id', $id1)->get();
                $people1[$j1]->group = $group1;
                if (! empty($group1[0])) {
                    $group1_people1 = [];
                    $gp1 = 0;
                    foreach ($people1[$j1]->group as $row1) {
                        $group1_people1[$gp1] = $row1;
                        $group1_people1[$gp1]->people = people::where('people.group_people_id', $row1->id)
                            ->join('positions', 'people.position_id', '=', 'positions.id')->orderBy('positions.ordinal', 'ASC')->select('people.*')->limit(5)->get();
                        $gp1++;
                    }
                }
                $people1[$j1]->people = People::where('people.borad_id', $row->id)
                    ->join('positions', 'people.position_id', '=', 'positions.id')->orderBy('positions.ordinal', 'ASC')->select('people.*')->limit(5)->get();
                $j1++;
            }
        }

        $menu_sub = sub_menu::where('join_database', 'index.board2')->where('join_database_id', $id1)->first();

        $data = $this->showMenu();
        $data['menu'] = $menu_sub;
        $data['borad'] = $borad;
        $data['people1'] = $people1;
        $data['people2'] = $people2;

        return view('Frontend.borad', $data);
    }
}
