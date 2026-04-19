<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Borad;
use App\Position;
use App\Main_menu;
use App\Sub_menu;



class PeopleController extends Controller
{
    
     
     public function index(Request $request)
    {	
         if(!$request->session()->has('user')) 
        {
            return redirect('login'); 
        }else
        {
    	   return $this->showDetailGroup();
        }
    }

    public function edit($id)
    {
    	return $this->showDetailGroup($id);
    	// return $id;
    }

    public function group(Request $request)
    {
    	$group = new Borad();
    	$group->name = $request->group_name;
    	$group->number_show = $request->number_show;
    	$group->status_use_prefix = $request->status_use_prefix;
    	$group->status_use_name = $request->status_use_name;
    	$group->status_use_lastname = $request->status_use_lastname;
    	$group->status_use_image = $request->status_use_image;
    	$group->status_use_borad = $request->status_use_borad;
    	$group->status_use_position = $request->status_use_position;
    	$group->status_use_other = $request->status_use_other;
        $group->status_use_telephone = $request->status_use_telephone;
        $group->status_use_email = $request->status_use_email;
    	$group->status_setting = $request->status_setting;
    	
    	$group->save();
    	return $this->showDetailGroup();
    	
    }
    public function people_update(Request $request)
    {
    
        $group = Borad::find($request->id);
        $group->name = $request->group_name;
        $group->number_show = $request->number_show;
        $group->status_use_prefix = $request->status_use_prefix;
        $group->status_use_name = $request->status_use_name;
        $group->status_use_lastname = $request->status_use_lastname;
        $group->status_use_image = $request->status_use_image;
        $group->status_use_borad = $request->status_use_borad;
        $group->status_use_position = $request->status_use_position;
        $group->status_use_other = $request->status_use_other;
        $group->status_use_telephone = $request->status_use_telephone;
        $group->status_use_email = $request->status_use_email;
        $group->status_setting = $request->status_setting;
        
        $group->save();
        return $this->showDetailGroup();     
    }    
    public function setting_update(Request $request)
    {
        $alert = ''; $success = '';
        if($request->mode == 'people'){
            $status = Borad::find($request->group_id);
            $status->status_setting = $request->status_setting;
            $alert = 'บันทึกสำเร็จ 999';
        } 
        
        $status->save();
        return response()->json([
            'status' => 'success',
            'alert' => $alert
        ]);
    }

    public function insert_position(Request $request)
    {
    
        $position = new Position();
        $position->name = $request->posotion_name;
        $position->save();
        return redirect()->route('people.index');
    }
    public function showDetailGroup($id = '')
    {
        $group_id = Borad::find($id);
        $position = Position::all();
        $data = $this->showMenu();
        $data['group_id'] = $group_id;
        $data['position'] = $position;
        return view('admin.setting_people', $data);
    	
    }
    public function showPosition($id = ''){
        $position_id = array();
        if(!empty($id)){
            $position_id = Position::find($id);
        }
       $group = Position::all();
    	return view('admin.setting_people', ['group' => $group, 'position_id' => $position_id]);
        
    }

}
