@extends('voyager::master')

@section("css")
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
@stop

@section('page_title', "Voyager - Custom albums")

@section('content')
    <div class="page-content settings container-fluid">
        <div class="panel panel-bordered">
            {!! Form::open() !!}
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label("name","Naam") !!}
                    {!! Form::text("name",$album->name,["class" => "form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("description","Omschrijving") !!}
                    <textarea class="form-control richTextBox" name="description" id="descriptiopn">
                        {{$album->description}}
                    </textarea>
                </div>
                <button class="btn btn-primary">Opslaan</button>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop   

