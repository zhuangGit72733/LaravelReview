@extends('articles.index')
@section('title','create')
@section('description')

    <form class="form-horizontal" method="post" action="{{ route('articles.store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="control-group">
            <label class="control-label" for="title">标题</label>
            <div class="controls">
                <input name="title" type="text" value="">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="content">内容</label>
            <div class="controls">
                <textarea name="content" style="width: 200px;height: 100px"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">

                <button type="submit" class="btn">新增</button>
            </div>
        </div>
    </form>
@endsection