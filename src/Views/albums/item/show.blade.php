@extends('voyager::master')

@section("css")
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
@stop

@section('page_title', "Voyager - Custom albums")

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-receipt"></i> {{$album_list_item->pathShow}}
            <a href="{{route("voyager.album_list.show",[$album_list->id])}}" class="btn btn-success">
                Terug
            </a>
    </h1>
@stop

@section('content')
    <div class="page-content settings container-fluid">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="row">
                            @foreach($images as $image)
                                <a href="{{$image}}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-1">
                                    <img src="{{$image}}" class="img-fluid" style="width:100%;">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop   

@section("javascript")
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script>

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });

</script>
@stop


