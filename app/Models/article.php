<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    public function mode_article()
    {
        return $this->belongsTo(mode_article::class, 'mode_article_id');
    }
}
