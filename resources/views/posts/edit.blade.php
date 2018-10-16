@extends('layouts.app')
@section('content')
    @if(Auth::user()->id == $post->user->id)
    <h1 class="text-center">Edit post</h1>
    {!! Form::open(['action' => ['PostsController@update',$post->id],'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title','title')}}
        {{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'title'])}}

    </div>
    <div class="form-group">
        {{Form::label('body','body')}}
        {{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'body' ])}}

    </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
        @else
        <h1 class="text-center">access denied</h1>
    @endif
@endsection
@section('js-includes')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection