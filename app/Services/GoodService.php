<?php

namespace App\Services;

use App\Models\Good;
use App\Services\ImageService;

class GoodService {
    public function delete_good($good_id) {
        $good = Good::where('id', $good_id)->first();
        (new ImageService())->delete_image($good->id);
        // relationships
        $good->materials()->detach();
        $good->sizes()->detach();
        $good->delete();
    }
}