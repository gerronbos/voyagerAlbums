<?php
namespace Hostingprecisie\VoyagerAlbums\Http\Controllers;

use App\User;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;
use Hostingprecisie\VoyagerForm\Models\Form;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use View,Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Hostingprecisie\VoyagerAlbums\Models\Album_list;
use Hostingprecisie\VoyagerAlbums\ServiceProviders\VoyagerAlbumServiceProvider;
use Hostingprecisie\VoyagerAlbums\Models\Album_list_item;


class VoyagerAlbumsController extends Controller
{
    public function create(Request $request){
        $view = "voyagerAlbums::albums.create";
        $album = new Album_list();
        $model_name = Album_list::class;

        return Voyager::view($view, compact(
            'album',
            "model_name"
        ));
    }

    public function edit(Album_list $album_list){
        $view = "voyagerAlbums::albums.create";
        $album = $album_list;
        $model_name = Album_list::class;

        return Voyager::view($view, compact(
            'album',
            "model_name"
        ));
    }

    public function update(Request $request, Album_list $album_list){
        VoyagerAlbumServiceProvider::update($album_list,$request->toArray());

        return Redirect::route("voyager.album_list.index");
    }

    public function store(Request $request){
        VoyagerAlbumServiceProvider::create($request->toArray());

        return Redirect::route("voyager.album_list.index");
    }

    public function delete(Request $request, Album_list $album_list){
        VoyagerAlbumServiceProvider::delete($album_list);

        return Redirect::route("voyager.album_list.index");
    }

    public function index(Request $request){
        $view = "voyagerAlbums::albums.index";
        $albums = Album_list::orderBy("name","asc")->get();
        $model_name = Album_list::class;
        $album_ids = Album_list::pluck("id")->all();

        return Voyager::view($view, compact(
            'albums',
            "model_name",
            "album_ids"
        ));
    }


    public function show(Album_list $album_list)
    {
        $view = "voyagerAlbums::albums.show";
        $album_list = $album_list;

        return Voyager::view($view, compact(
        'album_list'
        ));
    }
    public function showItem(Album_list $album_list, Album_list_item $album_list_item){
        $view = "voyagerAlbums::albums.item.show";
        $album_list = $album_list;
        $album_list_item = $album_list_item;
        $images = $album_list_item->images;

        return Voyager::view($view, compact(
        'album_list',
        "album_list_item",
        "images"
        ));
    }

    public function deleteItem(Album_list $album_list, Album_list_item $album_list_item){
        VoyagerAlbumServiceProvider::deleteItem($album_list_item);
        return redirect()->route('voyager.album_list.show', [$album_list->id]);
    }

    public function new_item(Album_list $album_list)
    {
        $view = "voyagerAlbums::albums.item.create";
        $album_list = $album_list;
        $item = new Album_list_item();
        $fb_albums = VoyagerAlbumServiceProvider::getFbAlbums();
        $normal_albums = VoyagerAlbumServiceProvider::getUploadAlbums();

        return Voyager::view($view, compact(
        'album_list',
        "item",
        "normal_albums"
        ));
    }

    public function postNew_item(Request $request, Album_list $album_list){
        VoyagerAlbumServiceProvider::addItem($album_list,$request->toArray());

        return redirect()->route('voyager.album_list.show', [$album_list->id]);
    }

    public function getAmountPhotos(Album_list $album_list){
        return $album_list->amountPhotos();
    }
}