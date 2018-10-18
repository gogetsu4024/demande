@extends('layouts.app')
@section('css-includes')
    <link href="/assets/node_modules/summernote/dist/summernote.css" rel="stylesheet" />
    <link href="/css/style.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Ajouter Projet</h4>
                </div>
                <div class="card-body">
                    <form method="POST"  action="{{ action('ProjetsController@store') }}">
                        <div class="form-body">
                            {!! csrf_field() !!}
                            <h3 class="card-title">choix du client</h3>
                            <hr>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select id="select" name="clientId" class="form-control custom-select">
                                        <option disabled selected>--Select your Client--</option>
                                        @foreach($clients as $row)
                                            <option value="{{$row->id}}">{{$row->nom}} @inc</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <h3 class="box-title m-t-40">Information general sur la mission</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Nom du projet </label>
                                        <input type="text" name="nom" id="nomClient" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback"> This is inline help </small> </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-7">
                                    <label class="control-label">Description du projet </label>
                                    <textarea id="ck-editor" name="description" ></textarea>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>

                                <!--/span-->
                            </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js-includes')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $(document).ready(function() {

            $('textarea').ckeditor('ck-editor');
        });

    </script>

@endsection