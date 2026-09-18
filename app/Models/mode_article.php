<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mode_article extends Model
{
    use HasFactory;

    protected $table = 'mode_articles';

    public function articles()
    {
        return $this->hasMany(article::class, 'mode_article_id');
    }
}
