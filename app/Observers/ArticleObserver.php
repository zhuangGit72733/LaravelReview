<?php

namespace App\Observers;

use App\Models\Article;

class ArticleObserver
{
    /**
     * 监听用户创建的事件。
     *
     * @param  Article $article
     * @return void
     */
    public function created(Article $article)
    {
        file_put_contents(public_path('articles/hello2.txt'), $article->content);
    }

    /**
     * 监听用户删除事件。
     *
     * @param Article $article
     * @return void
     */
    public function deleting(Article $article)
    {
        //
    }
}