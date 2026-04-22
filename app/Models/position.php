<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class position extends Model
{
    use HasFactory;

    public function people(){
    	// return $this->hasMany('App\Model\People');
    	// return People::Where('id',$this->)
    }

}
