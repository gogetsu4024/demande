@extends('layouts.app')
@section('content')
    <h1 class="text-center">Create post</h1>
    {!! Form::open(['action' => 'PostsController@store','method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title','title')}}
        {{Form::text('title','',['class'=>'form-control','placeholder'=>'title' ])}}

    </div>
        <div class="form-group">
            {{Form::label('body','body')}}
            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'body' ])}}

        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
@section('js-includes')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection