<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class sub_document extends Model
{
    use HasFactory;

    public function file_url(): string
    {
        $path = 'sub_document/'.$this->document_id.'/'.$this->file;
        if (! Storage::disk('public')->exists($path)) {
            $path = 'sub_document/'.$this->file;
        }

        return asset('storage/'.$path);
    }
}
