<?php

namespace Hostingprecisie\VoyagerAlbums\Models;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

class Album_list extends Model
{
    protected $table = 'album_list';


    public function items()
    {
        return $this->hasMany('Hostingprecisie\VoyagerAlbums\Models\Album_list_item');
    }

    public function getImagesAttribute(){
        $return = [];
        foreach($this->items as $item){
            $return = \array_merge($return,$item->images);
        }
        return $return;
    }
    public function getThumbAttribute(){
        $item = $this->items()->first();
        return $item->thumb;
    }

    public function amountPhotos(){
        $return = 0;
        foreach($this->items as $item){
            $return += $item->getAmountImages();
        }

        return $return;
    }

}
