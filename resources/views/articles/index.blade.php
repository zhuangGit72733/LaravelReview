@extends('layouts.app')
@section('title', 'Page-Title')
@section('content')
    <div class="container">
        <h1>Hello, world!</h1>
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @yield('description')

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
