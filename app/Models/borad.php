<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borad extends Model
{
     use HasFactory;
    protected $table = 'borads';

    public function people()
    {
        return $this->hasMany(people::class, 'borad_id', 'id');
    }

    public function group_people()
    {
        return $this->hasMany(group_people::class, 'borad_id', 'id');
    }

    public function position()
    {
        return $this->hasMany(position::class, 'borad_id', 'id')->orderBy('ordinal', 'asc');
    }

}
