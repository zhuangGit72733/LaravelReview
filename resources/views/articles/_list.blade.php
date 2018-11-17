@extends('articles.index')
@section('description')
    <table class="table table-bordered">
        <caption>边框表格布局</caption>

        <thead>
        <tr>
            <th>序号</th>
            <th>标题</th>
            <th>内容</th>
            <th>用户</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>编辑</th>
            <th>删除</th>


        </tr>
        </thead>
        <tbody>
        <a href="{{ route('articles.create') }}"><button type="submit" class="btn">新增</button></a>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->content }}</td>
                <td>{{ optional($article->user)->name }}</td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->updated_at }}</td>
                @can('options', $article)
                    <td> <a href="{{ route('articles.edit', $article->id) }}"><button type="button" class="btn">编辑</button></a></td>

                    <td>
                        <form action="{{ route('articles.destroy',$article->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn">删除</button>

                        </form>
                    </td>
                @else
                    <td></td>
                    <td></td>
                @endif
            </tr>

        @endforeach
        </tbody>
    </table>
    {{ $articles->links() }}
@endsection