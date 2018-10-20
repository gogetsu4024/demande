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
                    <h4 class="m-b-0 text-white">Ajouter Mission</h4>
                </div>
                <div class="card-body">
                    <form method="POST"  action="{{ action('MissionsController@store') }}">
                        <div class="form-body">
                            {!! csrf_field() !!}
                            <h3 class="box-title m-t-40">Information general sur la mission</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Nom de la mission </label>
                                        <input type="text" name="nom" id="nomClient" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback"> This is inline help </small> </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-7">
                                    <label class="control-label">Description de la mission </label>
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