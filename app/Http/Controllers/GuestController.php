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
use App\People;
use App\Company;
use App\Content;
use App\Product;
use App\sub_document;
use App\Document;
use App\Type_document;
use App\Category_document;
use App\Title_document;
use App\Banner;
use App\Type_quality;
use App\year;
use App\group_prople;
use Image;

class GuestController extends Controller
{

    public function index()
    {
		// $newpaper = $this->dc->get_newspaper_object(1);
  //       $news_cut = $newpaper->news(4);
		$name_sub1 = '';
		$name_sub2  = '';
		$data_detail_menu1 = array();
		$data_detail_menu2  = array();
		$calendar = $this->dc->get_calendar_object(12);
		$event_cut = $calendar->events(4);

		$name_sub1 = Type_document::where('name','เอกสาร/แบบฟอร์ม')->first();
		$data_detail_menu1 = Document::where('type_document_id',$name_sub1->id)->orderBy('created_at', 'DESC')->get();

		$name_sub2 = Sub_menu::where('name','ปฏิทินกิจกรรม')->first();
		$data_detail_menu2 = Detail_menu::where('sub_menu_id',$name_sub2->id)->orderBy('created_at', 'DESC')->get();


		$company = Company::all();
		$document = Document::offset(0)->limit(6)->get();
        // $template = Content::all();

		$data = $this->showMenu();
		// $data['news_cut'] = $news_cut;
		$data['event_cut'] = $event_cut;
		$data['company'] = $company;
        $data['document'] = $document;
		$data['name_sub1'] = $name_sub1;
		$data['name_sub2'] = $name_sub2;
		$data['data_detail_menu1'] = $data_detail_menu1;
		$data['data_detail_menu2'] = $data_detail_menu2;
		return dd($data);
		return view('index4', $data);
	}
	public function index1()
    {
//return view('error');
		$document = array();
		$calendar = $this->dc->get_calendar_object(12);
		$event_cut = $calendar->events(6);

		$md = People::where('position_id',1)->first();
		if(empty($md)){
			$md = People::where('position_id',32)->first();
		}

		$name_sub1 = Category_document::where('name','ประกาศรับทุนวิจัย')->first();
		// $data_detail_menu1 = Document::where('category_document_id',$name_sub1->id)->orderBy('created_at', 'DESC')->limit(8)->get();
		$data_detail_menu1 = Document::where('category_document_id',$name_sub1->id)->orderBy('created_at', 'DESC')->limit(10)->get();

		$name_sub2 = Category_document::where('name','ประกาศผลทุน')->first();
		$data_detail_menu2 = Document::where('category_document_id',$name_sub2->id)->orderBy('created_at', 'DESC')->limit(10)->get();

		$name_sub3 = Category_document::where('name','ข่าว')->first();
		$data_detail_menu3 = Document::where('category_document_id',$name_sub3->id)->orderBy('created_at', 'DESC')->limit(10)->get();

		$document = Document::limit(4)->get();
		$banner_top = Banner::where('place','top')->where('status_show',1)->orderBy('ordinal', 'ASC')->limit(10)->get();
		// $document = Document::all();
		
		$name_sub4 = Sub_menu::where('name','กิจกรรม')->orderBy('created_at', 'DESC')->first();
        $data_detail_menu4 = Detail_menu::where('sub_menu_id',$name_sub4->id)->orderBy('start_date', 'DESC')->limit(6)->get();
		


		$data = $this->showMenu();
		// $data['event_cut'] = $event_cut;
		$data['md'] = $md;
        $data['banner_top'] = $banner_top;
        $data['data_detail_menu1'] = $data_detail_menu1;
		$data['data_detail_menu2'] = $data_detail_menu2;
		$data['data_detail_menu3'] = $data_detail_menu3;
		$data['data_detail_menu4'] = $data_detail_menu4;

		// return dd($this->showMenu());
		return view('test', $data);
	}
	public function activity_all()
	{
		$calendar = $this->dc->get_calendar_object(19);
		$event_cut = $calendar->events(12);

		$data = $this->showMenu();
		$data['event_cut'] = $event_cut;
		// dd($data);
		return view('activity_show', $data);
	}
	public function activity_detail($id = '')
	{
		$gallery = new \NSRU\Event($this->dc);

		$gallery->load($id);
		$gallery_cut=$gallery->get_images();
		// $gallery_p = $gallery_cut->paginate(16);

		$data = $this->showMenu();
		$data['event_cut'] = $gallery;
		$data['gallery_cut'] = $gallery_cut;

		return view('activity_detail', $data);
	}
	public function news_all()
	{
		$newpaper = $this->dc->get_newspaper_object(32);
        $news_cut = $newpaper->news(12);

		$data = $this->showMenu();
		$data['news'] = $news_cut;
		// return dd($data);
		return view('news_show', $data);
	}
	public function news_detail($id = '')
	{
		$news_cut = new \NSRU\News($this->dc);

		$news_cut->load($id);
		// return dd($news_cut);
		$data = $this->showMenu();
		$data['news'] = $news_cut;
		// return dd($data);
		return view('news_detail', $data);
	}


	public function content_show($mode ='',$id = ''){
        $menu = array();
        $data_detail_menu = array();
        $data_company = array();
        $data_product = array();
        $data_document = array();
        $data_sub_document = array();
        $count_data = 0;
         $data_quality = array(); 
        $page = 'content2';
        if($mode == 'main')
        {
            $menu = Main_menu::find($id);
            $data_detail_menu = Detail_menu::where('main_menu_id',$id)->orderBy('id', 'desc')->get();
             $a = 'main';
        }elseif($mode == 'sub') {
            $menu = Sub_menu::find($id);
            $count_data = Detail_menu::where('sub_menu_id',$id)->count();
          	if ($id == 21){
                $data_detail_menu = Detail_menu::where('sub_menu_id',$id)->orderBy('start_date','desc')->paginate(9);
            }elseif($id != 21){
                $data_detail_menu = Detail_menu::where('sub_menu_id',$id)->get();

                if($id == 20){
                	$page = 'pdf2';
                }
            }

            if($id == 28){
            	$ii=0;
            	$quality = Type_quality::all();
		        foreach ($quality as $row) {
		            $data_quality[$ii] =  $row;
		            $data_quality[$ii]->year = year::where('type_quality_id',$row->id)->orderBy('year', 'desc')->get();
		            $data_quality[$ii]->year_start = year::where('type_quality_id',$row->id)->selectRaw('min(year) as year_min')->first();
		            $data_quality[$ii]->year_end = year::where('type_quality_id',$row->id)->orderBy('year', 'desc')->first();
		            $data_quality[$ii]->document = document::where('type_quality_id',$row->id)->orderBy('year', 'desc')->get();
		            $ii++;
		        }

            }

            $a = 'sub';
        }elseif($mode == 'company') {
            $data_company = Company::where('id',$id)->first();
            $a = 'company';
            $data_product = Product::where('company_id',$id)->get();
        }elseif($mode == 'document') {
            $data_document = Document::where('id',$id)->first();
            $a = 'document';
            $data_sub_documents = Sub_document::where('document_id',$id)->get();
        }


          if(!empty($data_sub_documents)){
          	$i=0;
            foreach ($data_sub_documents as $row) {
                $data_sub_document[$i] = $row;

                if (!empty($row->file)) {
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
        $data['data_quality'] = $data_quality;

        $data['mode'] = $a;
        $data['count_data'] = $count_data;
        //  dd($data);
		return view($page, $data);

	}
	public function content_detail($id = ''){

        $data_detail_menu = array();
		$data_detail_menu = Detail_menu::find($id);

		if(!empty($data_detail_menu->file))
		{
            $FileType = substr($data_detail_menu->file, -3);
            $data_detail_menu->filetype = $FileType;
        }

        $data = $this->showMenu();
        $data['data_detail_menu'] = $data_detail_menu;
        // return dd($data);
		return view('content_detail', $data);

	}
	public function quality_detail($id = '',$year = '')
	{
		$quality = Type_quality::where('id',$id)->first();
		$data_type = array(); $i_type = 0;
		$data_cate = array(); $i_cate = 0;
		$data = array(); $i = 0;

		$type = Type_document::where('type_quality_id',$id)->where('year',$year)->orderBy('id','asc')->get();
		foreach ($type as $row_type) {
			$data_type[$i_type] = $row_type;
			$data_type[$i_type]->category = Category_document::where('type_document_id',$row_type->id)->get();
			foreach ($data_type[$i_type]->category as $row_cate) {
				$data_cate[$i_cate] = $row_cate;
				$data_cate[$i_cate]->document = Document::where('category_document_id',$row_cate->id)->get();
				foreach ($data_cate[$i_cate]->document as $row) {
					$data[$i] = $row;
					$data[$i]->img = Sub_document::where('document_id',$row->id)->get();
					$i++;
				}
				$i_cate++;
			}
			$i_type++;
		}

		

        $data = $this->showMenu();
        $data['data_quality'] = $data_type;
        $data['quality'] = $quality;
        $data['year'] = $year;
        // return dd($data);
		return view('content_detail', $data);

	}
	public function board($id1 = '',$id2 ='')
	{
       $people2 = array();
       $page = 'board';
		// $j1 = 0;
		// $group1 = Borad::where('id', $id1)->get();
		// if (!empty($group1))
		// {
		// 	foreach ($group1 as $row)
		// 	{
		// 		$people1[$j1] = $row;
		// 		if ($row->id == 2) {
		// 			$people1[$j1]->people = People::where('borad_id',$row->id)->orderBy('id', 'ASC')->get();
		// 		}else{
		// 			$people1[$j1]->people = People::where('borad_id',$row->id)->orderBy('position_id', 'ASC')->get();
		// 		}

		// 		$j1++;
		// 	}
		// }

		// if (!empty($id1)&&!empty($id2)) {
		// 	$j2 = 0;
		// 	$group2 = Borad::where('id', $id2)->get();
		// 	if (!empty($group2))
		// 	{
		// 		foreach ($group2 as $row)
		// 		{
		// 			$people2[$j2] = $row;
		// 			$people2[$j2]->people = People::where('borad_id',$row->id)->get();
		// 			$j2++;
		// 		}
		// 	}
		// }


		$data_people = array();
		$j = 0;
		$data_borad = Borad::where('id', $id1)->first();
		if (!empty($data_borad))
		{
			$group = group_prople::where('borad_id',$data_borad->id)->orderBy('ordinal','asc')->get();
			foreach ($group as $row)
			{
				$data_people[$j] = $row;
				$data_people[$j]->people = People::where('group_prople_id',$row->id)->get();
				$j++;
			}
		}

		if($id1 == 1 || $id1 == 2){
			$page = 'board1';
		}



        $data = $this->showMenu();
        // $data['people1'] = $people1;
        // $data['people2'] = $people2;
         
        $data['data_borad'] = $data_borad;
        $data['data_people'] = $data_people;
         
        return view('board1', $data);
        // return view($page, $data);
	}
	public function document_all($id = ''){
        $i = 0;
        $year = array();

  //       $document_all = Document::orderBy('date_announcement', 'DESC')->paginate(4);
		// $mode = 'เอกสารทั้งหมด';

		$type = Type_document::all();

        if (!empty($id)) {
        	$document = Document::Where('type_document_id',$id)->get();
        	$mode = Type_document::Where('id',$id)->first()->name;
        }elseif ($id == 0){
        	$document = Document::all();
        	$mode = 'เอกสารทั้งหมด';
        }


        $data = $this->showMenu();
        $data['document_mode'] = $mode;
        $data['document_all'] = $document;
        // return dd($data);
		return view('content2', $data);
	}
	public function document_category($id = ''){
        $i = 0;
        $year = array();
        $document_notitle = array();
		$type = Type_document::all();
		$count_doc = 0;

        if (!empty($id)) {

        	$mode = Category_document::Where('id',$id)->first()->name;

        	$title = Title_document::Where('category_document_id',$id)->orderBy('created_at','desc')->get();
        	if ($title->count() != 0) {
        		foreach ($title as $row)
				{
					$j = 0;
					$data_doc = array();
					$document[$i] = $row;
					$document[$i]->sub_doc = Document::Where('title_document_id',$row->id)->orderBy('created_at','desc')->get();

					foreach ($document[$i]->sub_doc as $sub_doc) {
						$data_doc[$j] = $sub_doc;
						$data_doc[$j]->detail_doc = Sub_document::Where('document_id',$sub_doc->id)->get();
						$j++;
					}

					$i++;
				}
				if($id == 26){
					$document_notitle = Document::where('category_document_id',$id)->Where('title_document_id',null)->orderBy('created_at','desc')->get();
				}
				$have = 1;
        	}else{
        		$j = 0;
				$data_doc = array();

				$have = 0;
				$count_doc = Document::Where('category_document_id',$id)->count();

				if ($count_doc > 15) {
					$document = Document::Where('category_document_id',$id)->orderBy('created_at','desc')->paginate(15);
				}else{
					$document = Document::Where('category_document_id',$id)->orderBy('created_at','desc')->get();
				}

        		foreach ($document as $sub_doc) {
					$data_doc[$j] = $sub_doc;
					$data_doc[$j]->detail_doc = Sub_document::Where('document_id',$sub_doc->id)->get();
					$j++;
				}
        	}





        }elseif ($id == 0){
        	$j = 0;
			$data_doc = array();
        	$document = Document::orderBy('created_at','DESC')->get();
        	foreach ($document as $sub_doc) {
				$data_doc[$j] = $sub_doc;
				$data_doc[$j]->detail_doc = Sub_document::Where('document_id',$sub_doc->id)->get();
				$j++;
			}
        	$mode = 'เอกสารทั้งหมด';
        }


        $data = $this->showMenu();
        $data['document_mode'] = $mode;
        $data['document_category'] = $document;
        $data['document_notitle'] = $document_notitle;
        $data['have'] = $have;
        $data['count_doc'] = $count_doc;
        // return dd($data);

		return view('content2', $data);
	}
	//
	function fetch_data(Request $request)
    {
     if($request->ajax())
     {
       $data['document_all'] = Document::orderBy('date_announcement', 'DESC')->paginate(4);
      // return view('content', compact('data'))->render();
       // return redirect()->route('people.index');
       return view('content2', $data);
     }

       // $document_all = Document::orderBy('date_announcement', 'DESC')->paginate(4);

       //  if ($request->ajax()) {
       //      return view('content', ['document_all' => $document_all])->render();
       //  }

       //  return view('content', compact('articles'));


    }

	public function company_all($id = ''){
        $i = 0;
        $year = array();
		$company_all = Company::orderBy('date_join', 'ASC')->paginate(2);
		$mode = 'แนะนำบริษัทใหม่';

        $data = $this->showMenu();
        $data['company_mode'] = $mode;
        $data['company_all'] = $company_all;
		return view('content2', $data);
	}
	public function company_year($id = ''){
		$mode = 'การดูแลกลุ่ม SMEs';
		$i = 0;
        $company_year = array();
    	$year = Company::select('year_join')->groupBy('year_join')->get();

        if(!empty($year)){
            foreach ($year as $row) {
                $company_year[$i] = $row;
                $company_year[$i]->company_count=Company::where('year_join', $row->year_join)->count();
                $company_year[$i]->company = Company::where('year_join', $row->year_join)->orderBy('date_join', 'DESC')->get();
                $i++;

            }
        }

        $data = $this->showMenu();
        $data['company_mode'] = $mode;
        $data['company_year'] = $company_year;
		return view('content2', $data);

	}

	public function seach_document(Request $request){

        $bb  = Document::query();
		if (!empty($request->type_document_id)) {
			 $bb->where('type_document_id', $request->type_document_id);

		}

		if (!empty($request->category_document_id)) {
			 $bb->where('category_document_id', $request->category_document_id);
		}

		if (!empty($request->text_seach)){
			 $bb->where('name','like', '%'.$request->text_seach.'%');
		}
        // $bb->get();

        $document_all = $bb->paginate(4);
		$mode = 'คำค้น --';

        $data = $this->showMenu();
        $data['document_mode'] = $mode;
        $data['document_all'] = $document_all;
        // return dd($data);
		return view('content2', $data);
	}

	public function getStrLenTH($string)
	{
		$array = getMBStrSplit($string);
		$count = 0;

		foreach($array as $value)
		{
			$ascii = ord(iconv("UTF-8", "TIS-620", $value ));

			if( !( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 )) )
			{
				$count += 1;
			}
		}

		if ($count < 70) {
			return $string;
		}else{
			$num = $count - 70;
			return getSubStrTH($str, 0, $num);
		}
	}
	public function getSubStrTH($string, $start, $length)
	{
		$length = ($length+$start)-1;
		$array = getMBStrSplit($string);
		$count = 0;
		$return = "";

		for($i=$start; $i < count($array); $i++)
		{
			$ascii = ord(iconv("UTF-8", "TIS-620", $array[$i] ));

			if( $ascii == 209 ||  ($ascii >= 212 && $ascii <= 218 ) || ($ascii >= 231 && $ascii <= 238 ) )
			{
				//$start++;
				$length++;
			}

			if( $i >= $start )
			{
				$return .= $array[$i];
			}

			if( $i >= $length )
				break;
			}

		return $return;
	}


}
