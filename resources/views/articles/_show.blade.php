@extends('articles.index')
@section('title','create')
@section('sidebar')
    @if (count($errors) > 0)<!--错误反馈机制-->
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="form-horizontal" method="post" action="{{ route('comments.store') }}" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <div class="control-group">
            <label class="control-label" for="content">评论</label>
            <div class="controls">
                <textarea name="content" style="width: 200px;height: 200px"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">

                <button type="submit" class="btn">发布</button>
            </div>
        </div>
    </form>
@endsection
@section('description')

    <div class="control-group">
        <label class="control-label" for="title">{{ $article->title }}</label>
    </div>
    <div class="control-group">
        <div class="controls">
            <th>{{ $article->content }}</th>
        </div>
    </div>
    <table class="table">
        <caption>用户评论</caption>

        <thead>

        @foreach($comments as $comment)
            <tr>
                <th>{{ $comment->user->name }}&supdsub; {{ $comment->created_at }}</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $comment->content  }}</td>
        </tr>
        </tbody>
        @endforeach

    </table>

@endsection