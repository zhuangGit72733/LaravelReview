<?php

namespace App\Listeners;

use App\Events\ArticlesEvent;
use App\Models\Article;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticlesListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticlesEvent  $event
     * @return void
     */
    public function handle(ArticlesEvent $event)
    {

        //file_put_contents(public_path('articles/hello1.txt'), 'hello world');//监听事件生成
    }
}
