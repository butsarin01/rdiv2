<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    public function permisstion(){
    	// return $this->belongsTo('Position');
    	return Permisstion::Where('id',$this->permisstion_id)->first()->name;
    }
}
