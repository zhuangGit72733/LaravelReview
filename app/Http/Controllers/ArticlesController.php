<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');//中间件限制访问
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article,Request $request)
    {
      // $order = $request->order;
       $articles =  $article->orderBy('id', 'asc')->paginate(5);//列表页->字段排序->分页
        return view('articles._list',compact('articles'));//渲染视图，compact将变量传递
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();//调用关联模型的数据，Models/Articles.php
        return view('articles._create', compact('article', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Article $article)
    {
        $this->authorize('create', $article);//ArticlesPolicy.php授权create方式
        Validator::make($request->toArray(), [//图片过滤
            'title' => 'required|unique:articles|min:2',
            'content' => 'required',
        ],
            [
                'title.required' => '文章标题不能为空',
                'title.unique' =>'标题不能重复',
                'title.min' =>'标题至少两个字',
                'content.required'  => '内容不能为空',
            ])->validate();
        $article->fill($request->all());//变量填充
        $article->user_id = Auth::id();//获取用户id
        $article->save();
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $comments = $article->comments;
        return view('articles._show', compact('article', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article,Request $request)
    {

        $categories = Category::all();//调用关联模型的数据，Models/Articles.php
        return view('articles._edit', compact('article', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {

        $this->authorize('update', $article);//ArticlesPolicy.php授权
        $extension = $request->photo->extension();//获取文件扩展名
        $path = $request->photo->storeAs('images', md5(time()).'.'.$extension, 'custom');//存储路径
        $article->fill($request->all());//变量填充
        $article->photo = $path;
        $article->save();
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);//ArticlesPolicy.php授权
        $article->delete();
        return redirect()->route('articles.index');//重定向路由
    }
}
