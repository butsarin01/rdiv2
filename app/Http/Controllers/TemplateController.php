<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Main_menu;
use App\Sub_menu;
use App\Detail_menu;
use App\Borad;
use App\Position;
use App\template;
use App\Content;
use Image;

class TemplateController extends Controller
{
     public function set_content($id = '',$mode ='')
    {   
         if(!session()->has('user')) 
        {
            return redirect('login'); 
        }
        else
        {
            
            $template = Content::all();
          
            $data = $this->showMenu();
            $data['template'] = $template;

            // return dd($data);
            return view('admin.setting_content', $data);
        }
    }


     public function set_insert(Request $request)
    {   
       
        if(!empty($request->tem_id)){
           $template = Content::where('id',$request->tem_id)->first(); 

           	if ($request->hasFile('logo_main')) {
                Storage::disk('public')->delete('template/'.$template->logo_main);
            }
            if ($request->hasFile('logo_menu')) {
                Storage::disk('public')->delete('template/'.$template->logo_menu);
            }
        }else{
           $template = new Content(); 
        }

        if ($request->hasFile('logo_main')) {
            $new_image_name = uniqid().'.'.$request->logo_main->extension();

            $request->logo_main->storeAs('template',$new_image_name,'public');
            $template->logo_main = $new_image_name;
        }
        if ($request->hasFile('logo_menu')) {
            $new_image_name = uniqid().'.'.$request->logo_menu->extension();

            $request->logo_menu->storeAs('template',$new_image_name,'public');
            $template->logo_menu = $new_image_name;
        }

        $template->header_color = $request->color_header;
        $template->body_color = $request->color_body;
        $template->text_hover_color = $request->color_hover;
        $template->status_show_menu_top = $request->sub_top;
        $template->status_show_menu_left = $request->sub_left;


        $template->save();
        return redirect()->route('template.set');
       
    }
}
