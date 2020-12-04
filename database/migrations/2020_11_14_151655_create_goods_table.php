<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $storage_path = \Illuminate\Support\Facades\App::storagePath();
        $link_path = \Illuminate\Support\Facades\App::basePath().'/public/storage';

        if (!file_exists($storage_path.'/app/public/uploads/')) {
            Storage::disk('public')->makeDirectory('uploads');
        }

        if (!file_exists($link_path)) {
            Artisan::call('storage:link');
            echo 'migrate link. is_link($link_path) : ' . is_link($link_path).'. ';
        }

        Artisan::call('cache:clear');
        echo 'cache:clear called. ';

        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->string('code');
            $table->text('image');
            $table->double('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Storage::disk('public')->deleteDirectory('uploads');
        $link_path = \Illuminate\Support\Facades\App::basePath().'/public/storage';
        if (file_exists($link_path) && is_link($link_path)) {
            unlink($link_path);
            echo 'rollback unlink. is_link($link_path) : ' . is_link($link_path).'. ';
        }
        Schema::dropIfExists('goods');
    }
}
