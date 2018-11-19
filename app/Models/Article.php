<?php

namespace App\Models;

use App\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
class Article extends Model
{
    protected $fillable = [
        'user_id','title', 'content','category_id','photo'//Controller中允许写入的字段
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public  function category()
    {
        return $this->belongsTo(Category::class);
    }

    public  function comments()
    {
        return $this->hasMany(Comment::class);
    }





    public function getPhotoAttribute($v)
        //修改器定义photo的文件路径 ,
        //数据库有_的字段更改为驼峰命名
        //config文件夹中(filesystems.php).disks.custom.url
    {
        if ($v){
            return config('filesystems.disks.custom.url').'/'.$v;
        }
        else
            return "";
    }
}
