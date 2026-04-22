<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Main_menu;
use App\Models\Sub_menu;
use App\Models\Borad;
use App\Models\Position;
use App\Models\Member;
use App\Models\Content;
use App\Models\People;
use App\Models\Type_document;
use App\Models\Category_document;
use App\Models\Title_document;
use App\Models\Banner;
use App\Models\Detail_menu;
use App\Models\year;
use NSRU\App;
use Illuminate\Support\Facades\Cache;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $appID = '3027255233';
        $appSecret = 'E81O2FHOXKXIZINFJSXE' ;

        $app = new App($appID, $appSecret);
        $this->auth = $app->createMyAuth();
        $this->dc = $app->createDataCore();
    }

      protected function showMenu()
    {
        return Cache::remember('main-menu', 3600, function () {
            return $this->set_session_menu();
        });
    }
    protected function set_session_menu()
    {
        $main_menu_all = Main_menu::with([
            'sub_menu' => function ($q) {
                $q->orderBy('number_show', 'ASC');
            }
        ])
        ->orderBy('number_show', 'ASC')
        ->get();

        $group = Borad::orderBy('number_show', 'ASC')->get();
        $type_doc = Type_document::with('category')->get();
        $template = Content::find(1);
        $banner = Banner::where('place', 'right')
            ->where('status_show', 1)
            ->orderBy('ordinal', 'ASC')
            ->get();
        $visitors = $this->getVisitorsSummary();
         $md = People::where('position_id',1)->first();

        return [
            'main_menu_all' => $main_menu_all,
            'group' => $group,
            'template' => $template,
            'type_doc' => $type_doc,
            'visitors' => $visitors,
            'banner' => $banner,
            'md' => $md
        ];
    }

    protected function showMenuv1($id = '')
    {
        // dd(session()->all());
       session()->remove('main-menu');
       if(!session()->has('main-menu'))
       {
        $newpaper = $this->dc->get_newspaper_object(32);
        $news_cut = $newpaper->news(3);

        $menu = array(); $i = 0;
        $main_menu_all = Main_menu::orderBy('number_show', 'ASC')->get();
        if(!empty($main_menu_all)){
            foreach ($main_menu_all as $row) {
                $menu[$i] = $row;
                $menu[$i]->submenu = Sub_menu::where('main_menu_id', $row->id)->orderBy('number_show', 'ASC')->get();

                if(!empty($row->status_use_link) && empty($row->status_use_title) && empty($row->status_use_thumbnail) && empty($row->status_use_detail) && empty($row->status_use_gallery) && empty($row->status_use_file) && empty($row->join_database) && empty($row->join_database_id)  && $row->number_of_data == 1){
                    $link = Detail_menu::select('link')->where('main_menu_id',$row->id)->first();
                    $menu[$i]->link = $link;
                }
                $submenu = array(); $ii = 0;
                foreach ($menu[$i]->submenu as $row_sub) {
                    $submenu[$ii] = $row_sub;
                    if(!empty($row_sub->status_use_link) && empty($row_sub->status_use_title) && empty($row_sub->status_use_thumbnail) && empty($row_sub->status_use_detail) && empty($row_sub->status_use_gallery)&& empty($row_sub->status_use_file) && empty($row_sub->join_database) && empty($row_sub->join_database_id) && $row_sub->number_of_data==1){
                        $link = Detail_menu::select('link')->where('sub_menu_id',$row_sub->id)->first();
                        $submenu[$ii]->link = $link;
                    }
                    $ii++;
                }


                $i++;
            }
        }

        $group = Borad::orderBy('number_show', 'ASC')->get();

        $j = 0;$type_doc=null;
        $type_doc_all = Type_document::whereNull('type_quality_id')->get();
        if(!empty($type_doc_all)){
            foreach ($type_doc_all as $row) {
                $type_doc[$j] = $row;
                $type_doc[$j]->category = Category_document::where('type_document_id', $row->id)->orderBy('ordinal','asc')->get();
                $j++;
            }
        }

        $template = Content::all();
        $banner = Banner::where('place','right')->where('status_show',1)->orderBy('ordinal', 'ASC')->get();
        $md = People::where('position_id',1)->first();

        session()->put('main-menu', [
            'main_menu_all' => $menu,
            'group' => $group,
            'template' => $template,
            'news_cut' => $news_cut,
            'type_doc' => $type_doc,
            'banner' => $banner,
            'md' => $md
            ]);
        session()->save();
    }else{
           // session()->remove('main-menu');
           // session()->remove('main-menus');
           // session()->save();
    }

    return session()->get('main-menu');

}
public function main_menu()
{
    return $this->belongsTo('Main_menu', 'main_menu_id');
}

protected function login()
{
    $url = $this->auth->getSigninURL(url('loginpostback'),['_token'=>csrf_token()]);
    return redirect($url);


}

protected function loginpostback(Request $request){
    if(!$request->session()->has('user')) {
     $username = $request->username;
     // $username ='Supanee.p';
     $check_member = Member::where('username',$username)->first();
     if(!empty($check_member)|| $username=='butsarin.n'){

        $staff = $this->dc->find_staff($username);
        $request->session()->put('user', [
            'member_id' => $check_member->id,
            'permisstion' => $check_member->permisstion_id,
            'permisstion_name' => $check_member->permisstion(),
            'full_name' => $staff->full_name,
            'ldap_username' => $staff->ldap_username,
            'image_user' => $staff->portrait_image
        ]);
    }


}

return  redirect()->route('admin');
}

protected function logout(){

    $url = $this->auth->getSignoutURL(url('logoutpostback'),['_token'=>csrf_token()]);
    return redirect($url);

}
protected function logoutpostback(Request $request){
    $request->session()->forget('user');
    return redirect('/');
}

public function admin()
{
    $data = $this->showMenu();
        // return dd($data);
    return view('admin.admin', $data);
        // return view('admin.admin');
        // return view('admin.setting_menu', $data);
}

protected function today()
{
    return date("Y-m-d H:i:s",time());
}

protected function set_format_date($data = ""){
    $d = substr($data, 3,-5);
    $m = substr($data, 0,-8);
    $y = substr($data, -4);

    if ($y > 2500) {
        $y = $y-543;
    }

    $new_date = $y.'-'.$m.'-'.$d;
    return $new_date;
}

protected function set_document_setting($type_quality_id = "" ,$year = ""){
   if(!empty($year)){
    $year_last = $year;
}else{
    $year_check = year::where('type_quality_id',$type_quality_id)->orderBy('year', 'desc')->first();

    if (!empty($year_check)) {
        $year_last = $year_check->year;
    }else{
        $year_last = "";
    }
}


$count_data = 0;
$count_category = 0;
$count_title = 0;
$data_type = array();
$data_category = array();
$data_title = array();
$types = Type_document::where('type_quality_id',$type_quality_id)->where('year',$year_last)->get();
foreach ($types as $type) {
    $data_type[$count_data] = $type;
    $data_type[$count_data]->category = category_document::where('type_quality_id',$type_quality_id)->where('type_document_id', $type->id)->where('year', $year_last)->get();
    foreach ($data_type[$count_data]->category as $category) {
        $data_category[$count_category] = $category;
        $data_category[$count_category]->title = title_document::where('type_quality_id',$type_quality_id)->where('category_document_id', $category->id)->where('year', $year_last)->get();
        $count_category++;
    }
    $count_data++;
}
//        $data['set_document_setting'] = $data_type;

return $data_type;
}

 private function getVisitorCountByPeriod(Carbon $startDate, Carbon $endDate): int
    {
        $period = Period::create($startDate, $endDate);
        $data = Analytics::fetchTotalVisitorsAndPageViews($period);

        return $data->sum('screenPageViews') ?? 0;
    }

    public function getVisitorsSummary(): array
    {
        return [
            'today' => $this->getVisitorCountByPeriod(
                Carbon::today(),
                Carbon::today()
            ),

            'yesterday' => $this->getVisitorCountByPeriod(
                Carbon::yesterday(),
                Carbon::yesterday()
            ),

            'this_month' => $this->getVisitorCountByPeriod(
                Carbon::now()->startOfMonth(),
                Carbon::now()
            ),

            'last_month' => $this->getVisitorCountByPeriod(
                Carbon::now()->subMonth()->startOfMonth(),
                Carbon::now()->subMonth()->endOfMonth()
            ),

            'this_year' => $this->getVisitorCountByPeriod(
                Carbon::now()->startOfYear(),
                Carbon::now()
            ),

            'last_year' => $this->getVisitorCountByPeriod(
                Carbon::now()->subYear()->startOfYear(),
                Carbon::now()->subYear()->endOfYear()
            ),
        ];
    }



}
