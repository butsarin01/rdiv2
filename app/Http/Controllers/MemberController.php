<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class MemberController extends Controller
{
    public function index(Request $request)
    {	
        if(!$request->session()->has('user')) 
        {
            return redirect('login'); 
        }else{
        	$member = Member::all();
            $data = $this->showMenu();
            $data['member'] = $member;
            $data['session'] = session()->get('user');
            return view('admin.member', $data);
        }
    }
    public function insert(Request $request)
    {
    	$member = new Member();
    	$member->username = $request->username;
    	$member->permisstion_id = $request->permisstion_id;
    	
    	$member->save();
    	return redirect()->route('member.index');
    	
    }
     public function delete($id = '')
    {   
        $member = Member::find($id)->delete();

        return redirect()->route('member.index');
    }   
   
}
