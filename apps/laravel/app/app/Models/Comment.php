<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'parent_id',
        'name',
        'message',
    ];

    protected $dates = ['created_at', 'updated_at'];
    protected $table = 'comments';
    public $timestamps = true;
}
