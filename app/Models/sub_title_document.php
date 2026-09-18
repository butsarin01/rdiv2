<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sub_title_document extends Model
{
    use HasFactory;

    protected $table = 'sub_title_documents';

    public function title_document()
    {
        return $this->belongsTo(title_document::class, 'title_document_id');
    }

    public function documents()
    {
        return $this->hasMany(document::class, 'sub_title_document_id');
    }
}
