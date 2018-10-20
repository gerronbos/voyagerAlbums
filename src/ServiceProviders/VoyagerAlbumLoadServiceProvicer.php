<?php

namespace Hostingprecisie\VoyagerAlbums\ServiceProviders;

use Hostingprecisie\VoyagerForm\Models\Form;
use Hostingprecisie\VoyagerForm\Models\FormFields;
use Illuminate\Support\ServiceProvider;

class VoyagerAlbumsLoadServiceProvider
{
    public static function routes(){
       require __DIR__."/../routes/route.php";
    }

    public static function scripts(){
        $return = "<script src='".__DIR__."/../view/js/bootstrap-select.js'></script>";

        return $return;
    }
}
