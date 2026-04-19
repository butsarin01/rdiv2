<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sub_menu extends Model
{
     public function detail_menu()
    {
        return $this->hasMany('App\Detail_menu');
    }
}
