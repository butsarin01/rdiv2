<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_menu extends Model
{
    public function sub_menu()
    {
        return $this->hasOne('App\Sub_menu');
    }

    public function set_format_date_show(){
        $new_date = "";
        $start_date = $this->start_date;
        $end_date =  $this->end_date;
        $strtotime_start_date =strtotime($start_date);
        $strtotime_end_date =strtotime($end_date);

        if($start_date != 0000-00-00 && $end_date != 0000-00-00){
            if($start_date != $end_date){
                if($this->check_year($strtotime_start_date) == $this->check_year($strtotime_end_date)){
                    if($this->check_month($strtotime_start_date) == $this->check_month($strtotime_end_date)){
                        $new_date = $this->check_date($strtotime_start_date)."-".$this->check_date($strtotime_end_date)." ".$this->check_month($strtotime_start_date)." ".$this->check_year($strtotime_start_date);
                    }else{
                        $new_date = $this->check_date($strtotime_start_date)." ".$this->check_month($strtotime_start_date)."-"
                            .$this->check_date($strtotime_end_date)." "
                            .$this->check_month($strtotime_end_date)." "
                            .$this->check_year($strtotime_start_date);
                    }
                }else{
                    $new_date = $this->check_date($strtotime_start_date)." ".$this->check_month($strtotime_start_date)." ".$this->check_year($strtotime_start_date)."-"
                        .$this->check_date($strtotime_end_date)." " .$this->check_month($strtotime_end_date)." " .$this->check_year($strtotime_start_date);
                }
            }else{
                $new_date = $this->thai_datefull($start_date);
            }
        }elseif($start_date != 0000-00-00 && $end_date == 0000-00-00){
            $new_date = $this->thai_datefull($start_date);
        }elseif($start_date == 0000-00-00 && $end_date != 0000-00-00){
            $new_date = $this->thai_datefull($end_date);
        }
        return $new_date;
    }

    function check_date($tt = ""){
        $thai_date_return1 =  date("j", $tt);
        return $thai_date_return1;
    }
    function check_year($tt = ""){
        $thai_date_return3 =  (date("Y", $tt) + 543);
        return $thai_date_return3;
    }
    function check_month($tt = ""){
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
        $thai_date_return2 =  $thai_month_arr[date("n", $tt)];
        return $thai_date_return2;
    }

    public function thai_datefull($date = "")
    {
        // 19 ธันวาคม 2559
        $time = $date;
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
    public function start_date_input(){
        $tt = $this->set_format_date_input($this->start_date);
        return $tt;
    }
    public function end_date_input(){
        $tt = $this->set_format_date_input($this->end_date);
        return $tt;
    }

    public function set_format_date_input($date = " "){
        $tt =strtotime($date);
        $thai_date_return1 =  date("j", $tt);
        $thai_date_return2 =  date("n", $tt);
        $thai_date_return3 =  date("Y", $tt);
        $thai_date_return = $thai_date_return2."/".$thai_date_return1."/".$thai_date_return3;
        return $thai_date_return;
    }

    public function placeholder_img() {

        $placeholder = 'images/Placeholder-img-respon.png';
        // dd($this->thumbnail);
        // เช็คว่ามี thumbnail และไฟล์อยู่จริง
        if ($this->thumbnail && Storage::disk('public')->exists('content/' . $this->thumbnail)) {
            return asset('storage/content/' . $this->thumbnail);
        }
        return asset($placeholder);
    }
}
