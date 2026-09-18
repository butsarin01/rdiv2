<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisstion extends Model
{
    use HasFactory;

    /**
     * The legacy database uses the original misspelled table name.
     *
     * @var string
     */
    protected $table = 'permisstions';
}
