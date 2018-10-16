@extends('layouts.app')
@section('content')
    <a class="btn btn-danger" href="/posts/create">Create</a>
    <h1 class="text-center">Posts</h1>
    @if (count($posts)>0)
        @foreach($posts as $row)
            <div class="card p-3">
            <h2><a href="/posts/{{$row->id}}">{{$row->title}}</a></h2>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>no content</p>
    @endif
@endsection