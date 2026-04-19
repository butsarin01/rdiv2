<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Main_menu;
use App\Sub_menu;
use App\Borad;
use App\Position;

class MenuController extends Controller
{
	 public function index(Request $request)
    {	
        if(!$request->session()->has('user')) 
        {
            return redirect('login'); 
        }else{
    	   return $this->showDetailMain();
        }
    }

    public function edit($id)
    {
    	return $this->showDetailMain($id);
    }

    public function main(Request $request)
    {
    	$request->validate(['main_menu_name'=>'required','status_sub_menu'=>'required','number_show'=>'required'],['main_menu_name.required'=> 'กรุณากรอกหัวข้อ','status_sub_menu.required'=> 'กรุณาเลือกสถานะการมี sub menu','number_show.required'=> 'กรุณากรอกลำดับการแสดงของเมนู']
    );
    	$main_menu = new Main_menu();
    	$main_menu->name = $request->main_menu_name;
    	$main_menu->status_have_sub = $request->status_sub_menu;
    	$main_menu->number_show = $request->number_show;
    	$main_menu->status_use_title = $request->status_title;
    	$main_menu->status_use_thumbnail = $request->status_thumbnail;
    	$main_menu->status_use_detail = $request->status_detail;
    	$main_menu->status_use_gallery = $request->status_gallary;
    	$main_menu->status_use_file = $request->status_file;
    	$main_menu->status_use_link = $request->status_link;
        $main_menu->number_of_data = $request->number_of_data;
        $main_menu->status_setting = $request->status_setting;
        $main_menu->join_database = $request->join_database;
        
    	$main_menu->save();
    	
    	return $this->showDetailMain();
    	
    }
    public function main_update(Request $request)
    {
        // return dd($request);
        $main_menu = Main_menu::find($request->id);
        $main_menu->name = $request->main_menu_name;
        $main_menu->status_have_sub = $request->status_sub_menu;
        $main_menu->number_show = $request->number_show;
        $main_menu->status_use_title = $request->status_title;
        $main_menu->status_use_thumbnail = $request->status_thumbnail;
        $main_menu->status_use_detail = $request->status_detail;
        $main_menu->status_use_gallery = $request->status_gallary;
        $main_menu->status_use_file = $request->status_file;
        $main_menu->status_use_link = $request->status_link;
        $main_menu->number_of_data = $request->number_of_data;
        $main_menu->status_setting = $request->status_setting;
        $main_menu->join_database = $request->join_database;

        $main_menu->save();
        return $this->showDetailMain();
    }
    public function sub(Request $request)
    {
    	$sub_menu = new Sub_menu();
    	$sub_menu->name = $request->sub_menu_name;
    	$sub_menu->status_have_sub = $request->status_sub_menu;
        $sub_menu->number_show = $request->number_show;
        $sub_menu->main_menu_id = $request->main_menu_id;
    	$sub_menu->status_use_title = $request->status_title;
    	$sub_menu->status_use_thumbnail = $request->status_thumbnail;
    	$sub_menu->status_use_detail = $request->status_detail;
    	$sub_menu->status_use_gallery = $request->status_gallery;
    	$sub_menu->status_use_file = $request->status_file;
        $sub_menu->status_use_link = $request->status_link;
        $sub_menu->number_of_data = $request->number_of_data;
        $sub_menu->status_setting = $request->status_setting;
        $sub_menu->join_database = $request->join_database;
        
        $sub_menu->save();
        // return $this->showDetailMain();
        return redirect()->route('menu.edit',['id'=>$request->main_menu_id]);
    }

    public function setting_update(Request $request)
    {
        $alert = ''; $success = '';
        if($request->mode == 'main'){
            $status = Main_menu::find($request->main_id);
            $status->status_setting = $request->status_setting_main;
            $alert = 'บันทึกสำเร็จ 999';
        } else if($request->mode == 'sub'){
            $status = Sub_menu::find($request->sub_id);
            $status->status_setting = $request->status_setting_sub;
            $alert = 'บันทึกสำเร็จ 888';
        }
        
        $status->save();
        return response()->json([
            'status' => 'success',
            'alert' => $alert
        ]);
    }

    public function sub_edit($id)
    {
        $sub_menu_id = array();
        if(!empty($id)){
            $sub_menu_id = Sub_menu::find($id);
        }
        $data = $this->showMenu();
        $data['sub_menu_id'] = $sub_menu_id;
        return view('admin.setting_menu', $data);
        
    }
    public function showDetailMain($id = '')
    {
        $main_menu_id = array();
        $sub_menu_id = array();
        if(!empty($id))
        {
            $main_menu_id = Main_menu::find($id);
            $sub_menu_id = Sub_menu::where('main_menu_id',$id)->get();
            // $count_sub = Sub_menu::groupBy('main_menu_id')->selectRaw('count(*) as total, main_menu_id')->get(); 
        }
        $data = $this->showMenu();
        $data ['main_id'] = $main_menu_id;
        $data ['sub_id'] = $sub_menu_id;
        // $data ['count_sub'] = $count_sub;

        // return dd($data);
    	return view('admin.setting_menu', $data);
    	
    }

    public function httpGet($url){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //  curl_setopt($ch,CURLOPT_HEADER, false);
        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    public function showSearchName(){
        $ldap = 'butsarin.n';
        $token = $this->httpGet('http://ems.nsru.ac.th/service/get-token/mis/'.$ldap);
        $url = 'http://ems.nsru.ac.th/service/get-data-user/mis/'.$token.'/'.$ldap.'/'.urlencode('พงษ์ศักด์').'%20'.urlencode('สิริโสม');
        $user= json_decode($this->httpGet($url));
        return dd($user);
    }
    
}
