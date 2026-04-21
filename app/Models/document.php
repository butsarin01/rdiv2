<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    public function thai_datefull()
	{
	    // 19 ธันวาคม 2559
	    $time = $this->date_announcement;
	    $thai_month_arr = array(
	    "0"  => "",
	    "1"  => "มกราคม",
	    "2"  => "กุมภาพันธ์",
	    "3"  => "มีนาคม",
	    "4"  => "เมษายน",
	    "5"  => "พฤษภาคม",
	    "6"  => "มิถุนายน",
	    "7"  => "กรกฎาคม",
	    "8"  => "สิงหาคม",
	    "9"  => "กันยายน",
	    "10" => "ตุลาคม",
	    "11" => "พฤศจิกายน",
	    "12" => "ธันวาคม",
		);
	   	$tt =strtotime($time);
	    $thai_date_return1 =  date("j", $tt);
	    $thai_date_return2 =  $thai_month_arr[date("n", $tt)];
	    $thai_date_return3 =  (date("Y", $tt) + 543);
	    $thai_date_return = $thai_date_return1." ".$thai_date_return2." ".$thai_date_return3;
	    return $thai_date_return;
	}

	 public function datefull(){
    	$time = Document::Where('id',$this->id)->first()->date_announcement;
    	$tt =strtotime($time);
    	$date_return1 =  date("j", $tt);
	    $date_return2 =  date("n", $tt);
	    $date_return3 =  (date("Y", $tt) + 543);
	    $date_return = $date_return2."/".$date_return1."/".$date_return3;
	    return $date_return;
    }

	 public function member_permisstion(){
    	$per_id = Member::Where('id',$this->member_id_create)->first()->permisstion_id;
    	return Permisstion::Where('id',$per_id)->first()->name;
    }

    public function type_document(){
    	$type = Type_document::Where('id',$this->type_document_id)->first();
      if(!empty($type)){
        $name = $type->name;
      }else{
        $name = '-';
      }
      return  $name;
    }

    public function type_quality(){
      $type = Type_quality::Where('id',$this->type_quality_id)->first();
      if(!empty($type)){
        $name = $type->name_th;
      }else{
        $name = '-';
      }
      return  $name;
    }

    public function category_document(){
        $name = 'ทั้งหมด';
        $data = category_document::Where('id',$this->category_document_id)->first();
        if(!empty($data)){
            $name = $data->name;
        }
        return $name;
    }
    public function sub_document(){
        return sub_document::Where('document_id',$this->id)->get();
    }

    public function year(){
        $type = Type_document::Where('id',$this->type_document_id)->first();
        $year = !empty($type->year) ? $type->year : 0;
        return $year;
    }
     public function file_type(){
    	$filename = Document::Where('id',$this->id)->first()->file;
    	$filetype = substr($filename, -3);
          if ($filetype == 'pdf') {
          	$fileimage = 'images/pdf.png';
          }elseif ($filetype == 'ocx') {
          	$fileimage = 'images/word.png';
          }elseif ($filetype == 'doc') {
            $fileimage = 'images/word.png';
          }elseif ($filetype == 'ptx') {
          	$fileimage = 'images/powerpoint.png';
          }elseif ($filetype == 'lsx')   {
          	$fileimage = 'images/excel.png';
          }elseif ($filetype == 'zip') {
          	$fileimage = 'images/zip.png';
          }elseif ($filetype == 'rar') {
            $fileimage = 'images/zip.png';
          }else{
            $fileimage = 'images/images.png';
          }
      return $fileimage;
    	// return $filetype;
    }

     public function status_use(){
    	$status = Document::Where('id',$this->id)->first()->status_use;

          if ($status == 1) {
          	$status_name = 'ใช้งาน';
          }elseif ($status == 0) {
          	$status_name = 'ยกเลิก';
          }
    	return $status_name;
    }

   public function setfile(){
        $set_type_file = array();
        $color = '';
        $icon = '';

        $file = $this->file;
        $type_file = list($name, $type) = explode(".", $file);

        if ($type == 'pdf') {
            $color = '#ff5b57';
            $icon = '<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-pdf" style="color:'.$color.'"></i>';
        }elseif ($type == 'docx' || $type == 'doc') {
            $color = '#348fe2';
            $icon = '<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-word" style="color:'.$color.'"></i>';
        }elseif ($type == 'ptx') {
            $color = '#f59c1a';
            $icon = '<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-powerpoint" style="color:'.$color.'"></i>';
        }
        elseif ($type == 'rar') {
            $color = '#ffd900';
            $icon = '<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-folder" style="color:'.$color.'"></i>';
        }elseif ($type == 'xlsx') {
            $color = '#38761d';
            $icon = '<i class="far fa-lg fa-fw m-r-5 m-t-10 fa-file-excel"" style="color:'.$color.'"></i>';
        }

        $set_type_file['color'] = $color;
        $set_type_file['icon'] = $icon;
        $set_type_file['type'] = $type;

        return $set_type_file;
    }

}
