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
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'username' => optional($this->user)->name,
            'category' => optional($this->category)->name,
            'photo' => $this->photo,
        ];
    }
}
