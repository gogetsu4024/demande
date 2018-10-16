@extends('layouts.app')

@section('content')
    <h1>Hello</h1>
    <p>this is the {{$title}} page</p>
    <?php //echo $services[0]; ?>
    @if(count($services)!=0)
    <ul class="list-group">
        @foreach($services as $row)
            <li class="list-group-item">{{$row}}</li>
        @endforeach
    </ul>
    @endif





@endsection