<?php
// php artisan make:resource ArticleResource

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ArticleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [//说明
            'id' => $this->id,
            '标题' => $this->title,
            '内容' => $this->content,
            '用户名' => optional($this->user)->name,
            '分类' => optional($this->category)->name,
            '头像'=> $this->photo,
        ];
    }
}
