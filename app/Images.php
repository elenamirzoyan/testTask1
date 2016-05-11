<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';

    protected $fillable = ['id', 'name', 'slug', 'user_id', 'deleted'];

    public $timestamps = false;
}
