<?php

namespace Hostingprecisie\VoyagerAlbums\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Album_list_item extends Model
{
    protected $table = 'album_item';

    public function getPathShowAttribute(){
        if($this->path){
            return $this->path;
        }
        return "Facebook album_id: ".$this->fb_album_id;
    }

    public function getAmountImages(){
        return count($this->images);
    }

    public function getImagesAttribute(){
        $return = [];
        if($this->path){
            foreach(Storage::disk("public")->files($this->path) as $image){
                $return[] = Storage::disk("public")->url($image);
            }
            return $return;
        }
        return $return;
    }

}
