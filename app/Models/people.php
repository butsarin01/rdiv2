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
}
