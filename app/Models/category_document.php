<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_document extends Model
{
    use HasFactory;

    public function document()
    {
        $data = document::Where('category_document_id', $this->id)->orderBy('ordinal', 'asc')->get();
        return $data;
    }
}
