<?php
//php artisan make:controller Api\ArticlesController
namespace App\Http\Controllers\Api;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{
    public function index()
    {
        return ArticleResource::collection(Article::all());
    }
    public function show($id)
    {
        return  ArticleResource::make(Article::find($id));
    }
    public function store(Request $request)
    {
      $validator =  Validator::make($request->toArray(), [//图片过滤
          'photo' =>'required|image|max:200*1024',
          'title' => 'required|unique:articles|min:2',
          'content' => 'required',
          'category_id' => 'required|exists:categories,id',
          'user_id' => 'required|exists:users,id',
        ],
            [
                'photo.required' =>'文件不能为空',
                'photo.image' =>'文件样式不符',
                'photo.max' =>'文件大小不能超过200K',
                'title.required' => '文章标题不能为空',
                'title.unique' =>'标题不能重复',
                'title.min' =>'标题至少两个字',
                'content.required'  => '内容不能为空',
                'category_id.required' =>'分类不能为空',
                'category_id.in_array' =>'分类必须存在',
                'user_id.required' => '用户id不能为空',
                'user_id.exists' => '非法用户id'
            ]);
      if($validator->fails()){
          return \response()->json($validator->errors())->setStatusCode(403);
      }
        $article = new Article();
        $extension = $request->photo->extension();//获取文件扩展名
        $path = $request->photo->storeAs('images', md5(time()).'.'.$extension, 'custom');//存储路径
        $article->fill($request->all());//变量填充
        $article->photo = $path;//强制赋值photo
        $article->save();//变量存储数据
        return  response()->json(['status'=>true, 'createId' => $article->id])->setStatusCode(201);
    }
    public function update(Request $request)
    {
        $article = Article::find($request->article_id);
        $validator = Validator::make($request->toArray(), [//过滤请求信息，[name]，[提示]
            'title' => 'required|min:2',
            'content' => 'required',
            'photo' =>'image|max:200*1024',
            'category_id' => 'exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ],
            [
                'title.required' => '文章标题不能为空',
                'title.min' =>'标题至少两个字',
                'content.required'  => '内容不能为空',
                'photo.image' =>'图片样式不符',
                'photo.max' =>'图片大小不能超过200K',
                'user_id.required' =>'用户id不能为空',
                'user_id.exist' => '非法用户id',
            ]);
        if($validator->fails()){
            return \response()->json($validator->errors())->setStatusCode(403);
        }
        $article->fill($request->all());//变量填充数据
        if ($request->hasFile('photo')) {
            $extension = $request->photo->extension();//获取文件扩展名
            $path = $request->photo->storeAs('images', md5(time()).'.'.$extension, 'custom');//存储路径
            $article->photo = $path;//强制赋值photo
        }
        return $article->toArray();
        $article->save();//变量保存数据

        return response()->json(['status' => true,'updateId' => $article->id])->setStatusCode(201);
    }
    public function delete(Request $request)
    {
        $article = Article::find($request->article_id);//接口调用delete方法
        $article->delete();
        return [];
    }

}
