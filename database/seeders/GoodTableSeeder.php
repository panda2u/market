<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Good;
use Illuminate\Support\Facades\Storage;

class GoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $names = [
            'КПБ Бязь "Angelina"',
            'КПБ "Радуга" (бязь 125гр., нав. 70/70 1 шт.)',
            'КПБ страйп сатин "Мирослава" 1,5 сп.',
            'КПБ Бязь "Золотая стрекоза"',
            'КПБ пэ "Сказочный сон"',
            'КПБ страйп сатин "Мирослава" 1,5 сп.',
        ];
        $urls = [
            'https://avatars.mds.yandex.net/get-mpic/1923922/img_id3485673576547289781.jpeg/6hq',
            'https://avatars.mds.yandex.net/get-mpic/1860966/img_id1637650940979850376.jpeg/6hq',
            'https://avatars.mds.yandex.net/get-mpic/1642819/img_id4084633023519379720.jpeg/6hq',
            'https://avatars.mds.yandex.net/get-mpic/2008455/img_id8334595496725266885.jpeg/6hq',
            'https://avatars.mds.yandex.net/get-mpic/1687058/img_id4020855627421849641.jpeg/6hq',
            'https://avatars.mds.yandex.net/get-mpic/1864685/img_id3402628980077528742.jpeg/6hq',
        ];
        $prefix = 'image-file-';
        $subfolder = 'uploads/';

        foreach ($names as $i => $name) {
            $l = $i + 1;
            $code = strtolower(str_replace(' ', '-', str_replace([".", "'"],'', $name)));
            $sizes = [];

            $extension = '.png';
            $temp_name = $prefix.$l.$extension;

            Storage::disk('public')->put($subfolder.$temp_name, file_get_contents($urls[$i]));

            $mime = mime_content_type(Storage::path('uploads/'.$temp_name));
            $extension = str_replace('/', '.', substr($mime, strrpos($mime, '/') + 1));
            $image_file_name = $prefix.$l.'.'.$extension;

            Storage::disk('public')->move($subfolder.$temp_name, $subfolder.$image_file_name);

            $good = Good::factory()->create([
                'name' => $name,
                'code' => $code,
                'image'=> 'storage/'.$subfolder.$image_file_name,
            ]);

            $good->materials()->attach($l);

            for ($k = 0; $k < $l; $k++) {
                array_push($sizes, $k+1);
            }
            $good->sizes()->attach($sizes);
        }
    }
}
