@extends('voyager::master')

@section("css")
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
@stop

@section('page_title', "Voyager - Custom albums")
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> Album items van <span style="font-style: italic;">{{$album_list->name}}</span>
            <a href="{{route("voyager.album_list.new.item",[$album_list->id])}}" class="btn btn-success">
                <i class="voyager-plus"></i> {{ __('voyager.generic.add_new') }}
            </a>
    </h1>
@stop

@section('content')
    <div class="page-content settings container-fluid">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <th>path</th>
                        <th>Thumbnail</th>
                        <th>Opties</th>
                    </tr>
                    @foreach($album_list->items as $item)
                        <tr>
                            <td>{{$item->pathShow}}</td>
                            <td>
                                    <img src="{{$item->thumb}}" style="height:100px;" alt="...">
                            </td>
                            <td>
                            <a href="{{route("voyager.album_list.show.item",[$album_list->id,$item->id])}}" class="btn btn-primary">Inzien</a>
                                <a href="#" class="btn btn-danger delete" data-id="{{$item->id}}">Verwijder</a>
                            </td>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager.generic.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager.generic.delete_question') }} Formulier?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.album_list.show',[$album_list->id]) }}" id="delete_form" method="POST">
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

@section("javascript")
<script>
    var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) { // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction + '/' + $(this).data('id');
            console.log(form.action);

            $('#delete_modal').modal('show');
        });
</script>
@stop

