<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class main_menu extends Model
{
    use HasFactory;

    public function sub_menu()
    {
        return $this->hasMany(Sub_menu::class, 'main_menu_id');
    }


    public function count_sub_show()
    {
        $sub = sub_menu::where('main_menu_id', $this->id)->whereNull('join_database')->count();

        return $sub;
    }

    public function count_sub_no_show()
    {
        $sub = sub_menu::where('main_menu_id', $this->id)->whereNotNull('join_database')->count();

        return $sub ?? 0;
    }
}
