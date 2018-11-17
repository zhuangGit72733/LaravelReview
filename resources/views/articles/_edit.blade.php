@extends('articles.index')
@section('title','edit')
@section('description')

    <form class="form-horizontal" method="post" action="{{ route('articles.update', $article->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">

        <div class="control-group">
            <label class="control-label" for="title">标题</label>
            <div class="controls">
                <input name="title" type="text" value="{{ $article->title }}">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="content">内容</label>
            <div class="controls">
                <textarea name="content" style="width: 200px;height: 100px">{{ $article->content }}</textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">

                <button type="submit" class="btn">递交</button>
            </div>
        </div>
    </form>
@endsection
