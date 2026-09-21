<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    public function type_document()
    {
        return $this->belongsTo(type_document::class, 'type_document_id');
    }
}
