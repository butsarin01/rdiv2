<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_document extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->hasMany(Category_document::class, 'type_document_id');
    }

      public function category_document()
    {
        $data = category_document::Where('type_document_id', $this->id)->orderBy('ordinal', 'asc')->get();
        return $data;
    }

    public function document()
    {
        $data = document::Where('type_document_id', $this->id)->orderBy('ordinal', 'asc')->get();
        return $data;
    }

      public function get_data_document()
    {
        $data = array();
        if(!empty($this->id)){
            $data = document::where('type_document_id',$this->id)->get();
        }
        return $data;
    }
}
