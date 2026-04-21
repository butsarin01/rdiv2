<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;

    public function permisstion(){
    	// return $this->belongsTo('Position');
    	return Permisstion::Where('id',$this->permisstion_id)->first()->name;
    }

     public function permission()
    {
        $name = $this->permission_id;
        $data = permisstion::where('id', $this->permission_id)->first();
        if (! empty($data)) {
            $name = $data->name_th;
        }

        return $name;
    }
}
