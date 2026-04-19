<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Borad;
use App\Position;
use App\Main_menu;
use App\Sub_menu;
use App\Company;
use App\Sub_document;
use App\Document;
use App\Level_document;
use App\Sent_office;
use App\Type_document;
use App\Category_document;
use App\Title_document;
use App\Type_quality;
use App\year;

class DocumentController extends Controller
{
    public function index($id = '')
    {	
         if(!session()->has('user')) 
        {
            return redirect('login'); 
        }else
        {
	    	$data_document = array();
            $count_document = 0;
            $document = Document::orderBy('id', 'DESC')->get();
            $sent_office = Sent_office::all();


            foreach ($document as $doc){
                $data_document[$count_document] = $doc;
                $data_document[$count_document]->number_sub_document = Sub_document::where('document_id',$doc->id)->count();
                $count_document++;

            }

            $data = $this->showMenu();
            $data['document'] = $data_document;
            $data['sent_office'] = $sent_office;


	        return view('admin.document', $data);
        }
    }

    public function quality_index($id = '')
    {   
         if(!session()->has('user')) 
        {
            return redirect('login'); 
        }else
        {
            $data_document = array();
            $count_document = 0;
            $document = Document::whereNotNull('type_quality_id')->orderBy('id', 'DESC')->get();
            $sent_office = Sent_office::all();
            

            foreach ($document as $doc){
                $data_document[$count_document] = $doc;
                $data_document[$count_document]->number_sub_document = Sub_document::where('document_id',$doc->id)->count();
                $count_document++;

            }

            $data = $this->showMenu();
            $data['document'] = $data_document;
            $data['sent_office'] = $sent_office;


            return view('admin.quality_insert', $data);
        }
    }


    public function edit($id)
    {
        $page = '';
    	$data_sub_document = array();
        $document = Document::find($id);
        $check_sub_document = Sub_document::where('document_id',$id)->get();
        if(!empty($check_sub_document)){
            $data_sub_document = $check_sub_document;
        }

        if (!empty($document->type_quality_id)) {
            $page = 'admin.quality_edit';
        }else{
            $page = 'admin.document_edit';
        }

        $data = $this->showMenu();
        $data['document'] = $document;
        $data['sub_document'] = $data_sub_document;
        return view($page, $data);
    	// return $id;
    }


    public function document_insert(Request $request)
    {
        // dd($request->all());
        if(!empty($request->document_id)){
           	$document = Document::where('id',$request->document_id)->first(); 

           	if ($request->hasFile('image_name')) {
                Storage::disk('public')->delete('document_img/'.$document->thumbnail);
            }
            if ($request->hasFile('filename')) {
                Storage::disk('public')->delete('document/'.$document->file);
            }

            $document->member_id_update = $request->member_id;
        }else{
           $document = new Document();
           $document->member_id_create = $request->member_id;
        }

    	$document->name = $request->name;

    	if ($request->hasFile('image_name')) {
            $new_image_name = uniqid().'.'.$request->image_name->extension();

            $request->image_name->storeAs('document_img',$new_image_name,'public');
            $document->thumbnail  = $new_image_name;
        }

        if ($request->hasFile('filename')) {
            $new_file_name = uniqid().'.'.$request->filename->extension();

            $request->filename->storeAs('document',$new_file_name,'public');
            $document->file  = $new_file_name;
        }

        $d = substr($request->date_announcement, 3,-5);
        $m = substr($request->date_announcement, 0,-8);
        $y = substr($request->date_announcement, -4);

        if ($y > 2500) {
            $y = $y-543;
        }

        $new_date = $y.'-'.$m.'-'.$d;
        $document->date_announcement = $new_date;
        $document->number_document = $request->number_document;
    	
        $document->type_document_id = $request->type_document_id;
    	$document->category_document_id = $request->category_document_id;
        $document->sent_office_id = $request->sent_office_id;
        $document->level_document_id = $request->level_document_id;
        $document->title_document_id = $request->title_document_id;
        $document->status_use = $request->status_use;
        $document->ordinal = $request->ordinal;

        if (!empty($request->link)) {
            $document->link = $request->link;
        }
        
        $document->year = $request->year;
        $document->type_quality_id = $request->type_quality_id;
    	$document->detail = $request->detail;
    	 // return dd($new_date);
    	$document->save();  
        if (!empty($request->multifilename)) {
           
            if(!empty($request->document_id)){
                $data_detail = Sub_document::where('document_id',$request->document_id)->first();
                if(!empty($data_detail)){
                    $name_folder = $data_detail->id;
                    $name_path = '/sub_document/' . $name_folder;
                }else{
                    $name_folder = $request->document_id;
                    $name_path = '/sub_document/' . $name_folder;
                    $path = public_path() . $name_path;
                    File::makeDirectory($path, 0777, true, true);
                }
                $data_detail_id =  $request->document_id;

            }else {
                $data_detail = Document::where('name', $request->name)->where('created_at', $this->today())->first();

                $name_folder = $data_detail->id;
                $name_path = '/sub_document/' . $name_folder;
                $path = public_path() . $name_path;
                File::makeDirectory($path, 0777, true, true);

                $data_detail_id =  $data_detail->id;
            }

            foreach ($request->multifilename as $key => $value) {
                $sub_document = new Sub_document();

                $new_file_name = uniqid() . '.' . $value->extension();
                $value->storeAs($name_path, $new_file_name, 'public');

                $sub_document->document_id = $data_detail_id;
                $sub_document->name = $request->multiname[$key];
                $sub_document->status_use = $request->status_use;
                $sub_document->file = $new_file_name;

                $sub_document->save();
            }
        }
        // return redirect()->route('document.index');
    	return redirect()->back();
    	
    }
     public function delete_document($id = '')
    {   
        $document = Document::where('id',$id)->first();

        $sub_document_all = Sub_document::where('document_id',$document->id)->get();
        if(!empty($sub_document_all)){
            foreach ($sub_document_all as $row) {
                Storage::disk('public')->delete('sub_document/'.$id.'/'.$row->file);
                $sub_document = Sub_document::find($row->id)->delete();
            }
            File::deleteDirectory(public_path('sub_document/'.$id));
            File::deleteDirectory(public_path('\storage/sub_document/'.$id)); 
        }
        Storage::disk('public')->delete('document/'.$document->file);
        $document = Document::find($id)->delete();

        // return redirect()->route('document.index');
        return redirect()->back();
    }  
    public function sub_document($id = '')
    {   
        $document = Document::find($id);

        $sub_document = Sub_document::where('document_id',$id)->get();
        $data = $this->showMenu();
        $data['sub_document'] = $sub_document;
        $data['document'] = $document;
        return view('admin.document_sub', $data);
    }
     public function sub_document_insert(Request $request)
    {
        
        if(!empty($request->id)){
           	$sub_document = Sub_document::where('id',$request->id)->first(); 
           	if ($request->hasFile('filename')) {
                Storage::disk('public')->delete('sub_document/'.$sub_document->file);
            }
            $sub_document->member_id_update = $request->member_id;
        }else{
           $sub_document = new Sub_document();
           $sub_document->member_id_create = $request->member_id;
        }

        $sub_document->name = $request->name;

        if ($request->hasFile('filename')) {
            $new_file_name = uniqid().'.'.$request->filename->extension();

            $request->filename->storeAs('sub_document',$new_file_name,'public');
            $sub_document->file  = $new_file_name;
        }
        
        $sub_document->document_id = $request->document_id;
    	$sub_document->status_use = $request->status_use;
      
        
        $sub_document->save();  
        return redirect()->route('sub_document.show',[$request->document_id]);
        
    }

    public function delete_sub_document($id = '')
    {   
        $sub_document = Sub_document::where('id',$id)->first();
        $document_id = $sub_document->document_id;

        Storage::disk('public')->delete('sub_document/'.$document_id.'/'.$sub_document->file);

        $sub_document = Sub_document::find($id)->delete();

        // return redirect()->route('sub_document.show',['id'=>$document_id]);
        return redirect()->back();
    }


    public function sent_office_insert(Request $request)
    {
        
        if(!empty($request->sent_office_id)){
            $sent_office = Sent_office::where('id',$request->sent_office_id)->first(); 
        }else{
           $sent_office = new Sent_office();
        }

        $sent_office->name = $request->name;
        $sent_office->fullname = $request->fullname;
        $sent_office->address = $request->address;

         // return dd($request);
        $sent_office->save();  
        return redirect()->route('document.index');
        
    }
    public function delete_sent_office($id = '')
    {   
        $sent_office = Sent_office::find($id)->delete();
        return redirect()->route('document.index');
    }
    function fetch_year(Request $request)
    {
        $output = '';
        $select = $request->select;
        $value = $request->value;
        $dependent = $request->dependent;
        $data = year::where('type_quality_id', $value)->get();
        foreach ($data as $key => $row) {
            if ($key == 0) {
                $output = '<option value="' . $row->year . '">' . $row->year . '</option>';
            } else {
                $output .= '<option value="' . $row->year . '">' . $row->year . '</option>';
            }
        }
        return $output;
    }
     function fetch_type_document(Request $request)
    {
        $output = '';
        $select = $request->select;
        $value = $request->value;
        $dependent = $request->dependent;
        // $data = Type_document::where('year', $value)->get();
        $data = Type_document::where('type_quality_id', $value)->get();
        foreach ($data as $key => $row) {
            if ($key == 0) {
                $output = '<option value="' . $row->id . '">' . $row->name . '</option>';
            } else {
                $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
        }
        return $output;
    }  
    function fetch_category_document(Request $request)
    {
        $output='';
        $select = $request->select;
        $value = $request->value;
        $dependent = $request->dependent;
        $data = Category_document::where('type_document_id',$value)->get();
        foreach ($data as $key => $row) {
            if ($key == 0) {
                $output = '<option value="'.$row->id.'">'.$row->name.'</option>';
            }else{
                $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            } 
        }
        return $output;
    }

    function fetch_title_document(Request $request)
    {
        $output='';
        $select = $request->select;
        $value = $request->value;
        $dependent = $request->dependent;
        $data = Title_document::where('category_document_id',$value)->get();
        if (isset($data)) {
           foreach ($data as $key => $row) {
                if ($key == 0) {
                    $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
                }else{
                    $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
                }
            }
        }
        return $output;
    }
   
    public function setting_all($type_quality_id = "" ,$year= '')
    {
        $quality = Type_quality::all();

        $data_quality = array(); $i=0;

        foreach ($quality as $row) {
            $data_quality[$i] =  $row;
            $data_quality[$i]->year = year::where('type_quality_id',$row->id)->orderBy('year', 'desc')->get();
            $i++;
        }

        if(!empty($year) && !empty($type_quality_id)){
            $year_all = year::where('type_quality_id',$type_quality_id)->where('year', $year)->get();
        }else{
            $year_all = array();
        }


        if(!empty($year)){
            $year_last =$year;
        }else{
            $year_check = year::where('type_quality_id',$type_quality_id)->orderBy('year', 'desc')->first();

            if (!empty($year_check)) {
                $year_last = $year_check->year;
            }else{
                $year_last = "";
            }
        }

        if(!empty($type_quality_id)){
            $type_quality_id_last =$type_quality_id;
        }else{
            $type_quality_id_last = "";
        }

        $data = $this->showMenu();
        $data['set_document_setting'] = $this->set_document_setting($type_quality_id,$year);
        $data['data_quality'] = $data_quality;
        $data['year'] = $year_last;
        $data['quality'] = $type_quality_id_last;
        $data['years'] = $year_all;

       // dd($data);
        return view('admin.quality', $data);

    }
    function fetch_dataAll_document(Request $request)
    {
        $output = array();
        $Subtitle = '';
        $title = '';
        $category = '';
        $type = '';
        $year = '';

//        dd($request->all());

       if($request->mode == 'title'){
            $title = Title_document::where('id',$request->id)->first();
            $category = Category_document::where('id',$title->category_document_id)->first();
            $type = Type_document::where('id',$title->type_document_id)->first();
            $year = $title->year;
        }elseif($request->mode == 'category'){
            $category = Category_document::where('id',$request->id)->first();
            $type = Type_document::where('id',$category->type_document_id)->first();
            $year = $category->year;
        }elseif($request->mode == 'type'){
            $type = Type_document::where('id',$request->id)->first();
            $year = $type->year;
        }

        $output = [
            // 'Subtitle' => $Subtitle,
            'title' => $title,
            'category' => $category,
            'type' => $type,
            'year' => $year
        ];

        return $output;
    }


     public function title_document_insert(Request $request)
    {
        if(!empty($request->id_title)){
           $title = Title_document::where('id',$request->id_title)->first();
        }else{
           $title = new Title_document();
        }
        $title->name = $request->name_title;
        $title->type_document_id = $request->id_type;
        $title->category_document_id = $request->id_category;
        $title->year = $request->year;
        // dd($request->year);
        $title->save();

        $arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);

        // return redirect()->route('document.index');
        return redirect()->back();
    }

    public function category_document_insert(Request $request)
    {
        if(!empty($request->id_Category)){
           $category = Category_document::where('id',$request->id_Category)->first();
        }else{
           $category = new Category_document();
        }
        $category->name = $request->name_Category;
        $category->type_document_id = $request->id_type;
        $category->year = $request->year;
        $category->save();

        // return redirect()->route('document.index');
        return redirect()->back();
    }

    public function type_document_insert(Request $request)
    {
//        dd($request->id_type);
        if(!empty($request->id_type)){
           $type = Type_document::where('id',$request->id_type)->first();
        }else{
           $type = new Type_document();
        }
        $type->name = $request->name_type;
        $type->year = $request->year;
        $type->save();

        // return redirect()->route('document.index');
        return redirect()->back();
    }

    public function type_document_delete($id = '')
    {

        $categorys = Category_document::where('type_document_id',$id)->get();
        if (!empty($categorys)) {
            foreach ($categorys as $category) {
               $titles = Title_document::where('category_document_id',$category->id)->get();
               if (!empty($titles)) {
                    foreach ($titles as $title) {
                        $t = Title_document::find($title->id)->delete();
                    }
               }
               $c = Category_document::find($category->id)->delete();
            }

        }
        $type = Type_document::find($id)->delete();
        return redirect()->back();

    }
    public function category_document_delete($id = '')
    {
       $titles = Title_document::where('category_document_id',$id)->get();
       if (!empty($titles)) {
            foreach ($titles as $title) {
                $t = Title_document::find($title->id)->delete();
            }
       }
       $c = Category_document::find($id)->delete();
        return redirect()->back();
    }

    public function title_document_delete($id = '')
    {
        $t = Title_document::find($id)->delete();

        return redirect()->back();
    }

    public function year_insert(Request $request)
    {

        $year_check = year::where('type_quality_id',$request->type_quality_id)->orderBy('year', 'desc')->first();

        if ($year_check != "") {
            $year_last = $year_check->year;
        }else{
            $year_last = " ";
        }


        $today = date("Y-m-d H:i:s");

        $year = new year();
        $year->year = $request->year;
        $year->type_quality_id = $request->type_quality_id;
        $year->save();

        $count_data = 0;
        $count_category = 0;
        $count_title = 0;
        $data = array();
        $data_type = array();
        $data_category = array();
        $data_title = array();
        $types = Type_document::where('type_quality_id',$request->type_quality_id)->where('year',$year_last)->get();
        if(!empty($types)){
            foreach ($types as $key =>  $row){
                $type = new Type_document();
                $type->name = $row->name;
                $type->year = $request->year;
                $type->type_quality_id = $row->type_quality_id;
                $type->save();

                $data_type = Type_document::where('year',$request->year)->where('name',$row->name)->where('created_at',$today)->first();

                $categorys = Category_document::where('type_document_id',$row->id)->where('year',$year_last)->get();
                foreach ($categorys as $key1 =>  $row1){
                    $category = new Category_document();
                    $category->name = $row1->name;
                    $category->type_document_id = $data_type->id;
                    $category->year = $request->year;
                    $category->type_quality_id = $row1->type_quality_id;

                    $category->save();

                    $data_category = Category_document::where('name',$row1->name)->where('type_document_id',$data_type->id)->where('year',$request->year)->where('created_at',$today)->first();

                    $titles = title_document::where('type_document_id',$row->id)->where('category_document_id',$row1->id)->where('year',$year_last)->get();
                    foreach ($titles as $key2 =>  $row2){
                        $title = new Title_document();
                        $title->name = $row2->name;
                        $title->type_document_id = $data_type->id;
                        $title->category_document_id = $data_category->id;
                        $title->year = $request->year;
                        $title->type_quality_id = $row2->type_quality_id;
                        $title->save();
                    }
                }
            }
        }


        return redirect()->route('setting_document.index');
    }

}
