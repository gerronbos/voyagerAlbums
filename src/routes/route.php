<?php
Route::group(['as' => 'voyager.',"prefix"=>"album_list","middleware"=>["web","admin.user"]], function () {
    Route::get('/', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@index','as' => 'album_list.index']);

    Route::delete('/{album_list}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@delete','as' => 'album_list.delete']);

    Route::get('/show/{album_list}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@show','as' => 'album_list.show']);
    Route::get('/show/{album_list}/{album_list_item}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@showItem','as' => 'album_list.show.item']);
    Route::delete('/show/{album_list}/{album_list_item}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@deleteItem']);
    Route::get('/show/{album_list}/new/item', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@new_item','as' => 'album_list.new.item']);
    
    Route::post('/show/{album_list}/new/item', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@postNew_item']);
    
    Route::get('/create', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@create','as' => 'album_list.create']);
    Route::post('/create', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@store']);

    Route::get('/edit/{album_list}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@edit','as' => 'album_list.edit']);
    Route::post('/edit/{album_list}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@update']);

    Route::get('/photos/{album_list}', ['uses' => '\Hostingprecisie\VoyagerAlbums\Http\Controllers\VoyagerAlbumsController@getAmountPhotos','as' => 'album_list.photos.amount']);
});