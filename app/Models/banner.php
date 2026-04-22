<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class banner extends Model
{
     use HasFactory;

    public function placeholder_img() {

        $placeholder = 'images/Placeholder-img-respon.png';
        // dd($this->thumbnail);
        // เช็คว่ามี thumbnail และไฟล์อยู่จริง
        if ($this->file && Storage::disk('public')->exists('content/' . $this->file)) {
            return asset('storage/content/' . $this->file);
        }
        return asset($placeholder);
    }
}
