<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Setting;

class VoyagerAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->timestamps();
        });
        Schema::create('album_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("album_list_id");
            $table->string('path')->nullable();
            $table->string('fb_album_id')->nullable();
            $table->string('thumb')->nullable();
            $table->timestamps();
        });

        //Add permissions
        $permission_add = new Permission();
        $permission_add->key = "add_album_list";
        $permission_add->table_name = "album_list";
        $permission_add->save();

        $permission_edit = new Permission();
        $permission_edit->key = "edit_album_list";
        $permission_edit->table_name = "album_list";
        $permission_edit->save();

        $permission_delete = new Permission();
        $permission_delete->key = "delete_album_list";
        $permission_delete->table_name = "album_list";
        $permission_delete->save();

        $permission_delete = new Permission();
        $permission_delete->key = "browse_album_list";
        $permission_delete->table_name = "album_list";
        $permission_delete->save();

        //Add data_type
        $data_type = new DataType();
        $data_type->name = "album_list";
        $data_type->slug = "album_list";
        $data_type->display_name_singular = "Album lijst";
        $data_type->display_name_plural = "Album lijsten";
        $data_type->icon = "voyager-receipt";
        $data_type->model_name = "Hostingprecisie\VoyagerAlbums\Models\Album_list";
        $data_type->generate_permissions = 1;
        $data_type->save();

        //Add MenuItem
        $menu_item = new MenuItem();
        $menu_item->menu_id = 1;
        $menu_item->title = "Album lijsten";
        $menu_item->url = "";
        $menu_item->target = "_self";
        $menu_item->icon_class = "voyager-photos";
        $menu_item->order = MenuItem::where("menu_id",'=',1)->count() + 2;
        $menu_item->route = "voyager.album_list.index";
        $menu_item->save();

        $setting = new Setting();
        $setting->key = "socialmedia.fb_page_id";
        $setting->display_name = "Facebook page id";
        $setting->type = "text";
        $setting->order = Setting::where("group",'=',"socialmedia")->count() + 1;
        $setting->group = "socialmedia";
        $setting->save();

        $setting2 = new Setting();
        $setting2->key = "socialmedia.fb_page_id";
        $setting2->display_name = "Facebook page id";
        $setting2->type = "text";
        $setting2->order = Setting::where("group",'=',"socialmedia")->count() + 1;
        $setting2->group = "socialmedia";
        $setting2->save();

        $setting3 = new Setting();
        $setting3->key = "socialmedia.fb_page_id";
        $setting3->display_name = "Facebook page id";
        $setting3->type = "text";
        $setting3->order = Setting::where("group",'=',"socialmedia")->count() + 1;
        $setting3->group = "socialmedia";
        $setting3->save();

        if (!Storage::disk("public")->exists("Albums")) {
            Storage::disk("public")->makeDirectory("Albums");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
