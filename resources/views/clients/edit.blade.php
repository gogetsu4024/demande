@extends('layouts.app')
@section('css-includes')
    <link rel="stylesheet" href="/assets/node_modules/dropify/dist/css/dropify.min.css">
    <link href="/css/style.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Ajouter Client</h4>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ action('ClientsController@update',$client->id) }}">
                        <div class="form-body">
                            @method('PUT')
                            {!! csrf_field() !!}
                            <h3 class="card-title">Information general sur le client</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">nom de client</label>
                                        <input type="text" value="{{$client->nom}}" name="nom" id="nomClient" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback"> This is inline help </small> </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">Email de contact</label>
                                        <input type="text" value="{{$client->email}}" name="email" id="emailClient" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback"> This is inline help </small> </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label">numero de tel</label>
                                        <input value="{{$client->Tel}}" type="number" name="Tel" id="numTel" class="form-control" placeholder="John doe">
                                        <small class="form-control-feedback"> This is inline help </small> </div>
                                </div>
                                <!--/span-->
                                <!--/span-->
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-lg-7 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">File Upload2</h4>
                                            <label for="input-file-now-custom-1">You can add a default value</label>
                                            <input name="imageToUpload" type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{$client->picture_Path}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--/row-->
                            <!--/row-->
                            <h3 class="box-title m-t-40">Address</h3>
                            <hr>
                            <input hidden  name="adresseId" value="{{$client->addresse->id}}">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label>Street</label>
                                        <input value="{{$client->addresse->rue}}" type="text" name="rue" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input value="{{$client->addresse->cite}}" type="text" name="cite" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input value="{{$client->addresse->etat}}" type="text" name="etat" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Post Code</label>
                                        <input value="{{$client->addresse->codePostal}}" type="text" name="codePostal" class="form-control">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select id="select" name="pays" class="form-control custom-select">
                                            <option disabled selected>--Select your Country--</option>

                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
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
    <script src="/assets/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            // Basic
            $.getJSON("/assets/names.json", function(json){

                let selected = "{{$client->addresse->pays}}";
                $.each(json, function(i, obj){
                    console.log(selected);
                    if (obj!=selected)
                        $('#select').append($('<option>').text(obj).attr('value', obj));
                    else
                        $('#select').append($('<option>').text(obj).attr('value', obj).attr('selected',"selected"));
                });
            });

            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function(event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function(e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>

@endsection