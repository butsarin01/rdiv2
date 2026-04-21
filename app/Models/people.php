<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class people extends Model
{
    public function position(){
    	// return $this->belongsTo('Position');
    	return Position::Where('id',$this->position_id)->first()->name;
    }
    public function prefix(){
    	// return $this->belongsTo('Position');
    	return Prefix::Where('id',$this->prefix_id)->first()->name;
    }

     public function show_image()
    {
        if (!empty($this->thumbnail)){
            $image = asset('storage/people/' . $this->thumbnail);
        }elseif (!empty($this->link_image)){
            $image = $this->link_image;
        }else{
            if ($this->prefix_id == 3 || $this->prefix_id == 2){
                // $image = asset('images/woman.png');
                $image = asset('images/person.png');
            }elseif($this->prefix_id == 1){
                $image = asset('images/person.png');
                // $image = asset('images/man.png');
            }else{
                $image = asset('images/person.png');
                // $image = asset('images/no-image-icon-23483.png');
            }
        }

        return $image;
    }
}
