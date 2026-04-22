<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_menu extends Model
{
    use HasFactory;

     public function detail_menu()
    {
        return $this->hasMany('App\Detail_menu');
    }

    public function main_menu()
   {
       return $this->belongsTo(main_menu::class, 'main_menu_id', 'id');
   }
}
