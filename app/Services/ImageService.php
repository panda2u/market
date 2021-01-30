<?php

namespace App\Services;

use App\Models\Good;
use Illuminate\Support\Facades\Storage;

class ImageService {

    public function delete_image ($good_id) { // storage disk
        $good = Good::where('id', $good_id)->first();
        $path = str_replace('storage/', '', $good->image);
        Storage::disk('public')->delete($path);
        $good->image = '';
        $good->save();
    }
}