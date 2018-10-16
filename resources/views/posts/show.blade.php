@extends('layouts.app')
@section('content')
    <a class="btn btn-danger" href="/posts">go back</a>
    <h3 class="text-center">{{$post->title}}</h3>
        {!!$post->body!!}
    <hr>
    <small>written on {{$post->created_at}}// by {{$post->user->name}}</small>
    <hr>


    @if(!Auth::guest())
        @if(auth()->user()->id == $post->user->id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">modify</a>
    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
        @endif
    @endif
@endsection