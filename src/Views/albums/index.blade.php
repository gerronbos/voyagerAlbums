@extends('voyager::master')

@section("css")
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
@stop

@section('page_title', "Voyager - Custom albums")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Albums
            <a href="{{route("voyager.album_list.create")}}" class="btn btn-success">
                <i class="voyager-plus"></i> {{ __('voyager.generic.add_new') }}
            </a>
    </h1>
@stop

@section('content')
    <div class="container-fluid">
        @include('voyager::alerts')
        @if(config('voyager.show_dev_tips'))
        <div class="alert alert-info">

        </div>
        @endif
    </div>

    <div class="page-content settings container-fluid">
        <table class="table table-borderd">
            <tr>
                <th style="width:30px;">ID</th>
                <th>Name</th>
                <th>Photo's</th>
                <th>Actions</th>
            </tr>
            @if(!count($albums))
                <td colspan="10">
                    Er zijn nog geen albums toegevoegd.
                </td>
            @else
                @foreach($albums as $album)
                    <tr>
                        <td>{{$album->id}}</td>
                        <td>{{$album->name}}</td>
                        <td id="photos_{{$album->id}}"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></td>
                        <td style="width:30%;">
                            <a href="{{route("voyager.album_list.show",[$album->id])}}" class="btn btn-primary">Inzien</a>
                        <a href="{{route("voyager.album_list.edit",[$album->id])}}" class="btn btn-success">Wijzig</a>
                            <a href="#" class="btn btn-danger delete" data-id="{{$album->id}}">Verwijder</a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>

    </div>

{!! Form::open(["id"=>"change_row_form"]) !!}
<input type="hidden" name="direction" id="change_row_direction">
{!! Form::close() !!}

<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager.generic.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager.generic.delete_question') }} Formulier?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.album_list.delete',[1]) }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                                 value="{{ __('voyager.generic.delete_confirm') }} Formulier">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager.generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
<script>
    var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');
            console.log(form.action);

            $('#delete_modal').modal('show');
        });
</script>

<script>
var album_ids = @json($album_ids);
var url = "{{route('voyager.album_list.photos.amount',[':id'])}}";
$(document).ready(function () {
    $.each(album_ids,function(index,item){
        $.get(url.replace(":id",item),function(data){
            var html = document.getElementById("photos_"+item);
            html.innerHTML = data;
        });
    });
});
</script>

@stop
