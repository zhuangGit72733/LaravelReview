@extends('articles.index')
@section('sidebar')
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><a href="#">首页</a></td>
        </tr>
        <tr>
            <td><a href="#">分类</a></td>
        </tr>
        </tbody>
    </table>
@endsection
@section('description')
    <table class="table table-bordered">
        <caption>边框表格布局</caption>

        <thead>
        <tr>
            <th>序号</th>
            <th>标题</th>
            <th>分类</th>
            <th>用户</th>
            <th>头像</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>编辑</th>
            <th>删除</th>


        </tr>
        </thead>
        <tbody>
        <a href="{{ route('articles.create') }}"><button type="submit" class="btn">新增</button></a>
        @foreach($articles as $article)
            @can('options', $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></td>
                <td>{{ optional($article->category)->name }}</td>
                <td>{{ optional($article->user)->name }}</td>
                <td><img src="{{ $article->photo }}" style="width: 50px;height:50px;"> </td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->updated_at }}</td>
                    <td> <a href="{{ route('articles.edit', $article->id) }}"><button type="button" class="btn">编辑</button></a></td>

                    <td>
                        <form action="{{ route('articles.destroy',$article->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn">删除</button>

                        </form>
                    </td>
                @else
                @endif
            </tr>

        @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
    <script type="text/JavaScript">
        $.getJSON("http://qiandao.home.test/api/users/list",function(data){
            alert(data.name);
        });


    </script>
@endsection