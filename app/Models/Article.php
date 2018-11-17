<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'content','category_id','photo'//Controller中允许写入的字段
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
