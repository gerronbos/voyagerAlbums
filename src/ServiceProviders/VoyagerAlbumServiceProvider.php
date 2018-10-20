<?php

namespace Hostingprecisie\VoyagerAlbums\ServiceProviders;

use Hostingprecisie\VoyagerForm\Models\Form;
use Hostingprecisie\VoyagerForm\Models\FormFields;
use Illuminate\Support\ServiceProvider;
use Hostingprecisie\VoyagerAlbums\Models\Album_list;
use Illuminate\Support\Facades\Storage;
use Hostingprecisie\VoyagerAlbums\Models\Album_list_item;

class VoyagerAlbumServiceProvider extends ServiceProvider
{
    public static function create($items){
        $album = new Album_list();
        $album->name = $items["name"];
        $album->description = $items["description"];
        $album->save();
    }

    public static function delete(Album_list $album_list){
        foreach($album_list->items as $item){
            self::deleteItem($item);
        }
        $album_list->delete();
    }


    public static function update(Album_list $album, $items){
        $album->name = $items["name"];
        $album->description = $items["description"];
        $album->save();
    }

    public static function deleteItem(Album_list_item $album_list_item){
        $album_list_item->delete();
    }

    public static function addItem(Album_list $album, $item){
        $album_list_item = new Album_list_item();
        $album_list_item->album_list_id = $album->id;
        if($item["type"] == "path"){
            $album_list_item->path = $item["album_path"];
            $album_list_item->thumb = self::getThumbFromAlbum($item["album_path"]);
        }
        else{

        }
        $album_list_item->save();
    }

    public static function getUploadAlbums(){
        $albums = Storage::disk("public")->directories("/Albums");
        $return = [];

        foreach($albums as $album){
            if(self::getThumbFromAlbum($album)){
                $return[] = [
                    "name" => $album,
                    "path" => $album,
                    "thumb" => self::getThumbFromAlbum($album)
                ];
            }
        }
        return $return;
    }

    public static function getThumbFromAlbum($album){
        $files = Storage::disk("public")->files($album);
        if(isset($files[0])){
            return Storage::disk("public")->url($files[0]);
        }
        return null;
    }

    public static function getFbAlbums(){
        $access_token = self::getFbAccessToken();
        $page_id = setting('socialmedia.fb_page_id');

        $fields = "id,name,description,link,cover_photo,count";
        $graphAlbLink = "https://graph.facebook.com/v2.9/{$page_id}/albums?fields={$fields}&access_token={$access_token}";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $graphAlbLink,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            )
        ));

        $response = json_decode(curl_exec($curl));
    }

    public static function getFbAccessToken(){
        $client_id = setting('socialmedia.fb_client_id');
        $client_secret = setting('socialmedia.fb_client_secret');
        $graphActLink = "https://graph.facebook.com/oauth/access_token?client_id={$client_id}&client_secret={$client_secret}&grant_type=client_credentials";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $graphActLink,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_TIMEOUT => 3000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            )
        ));

        $response = json_decode(curl_exec($curl));

        return $response->access_token;
    }
}
