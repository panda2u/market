<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alls_izes = [
            '1_5' => '1,5 спальный',
            '2_0' => '2,0 спальный',
            '2_0_euro' => '2,0 спальный с евро',
            'child' => 'детский',
            'euro' => 'евро',
            'family' => 'семейный ',
        ];

        foreach ($alls_izes as $key => $value) {
            $s = new Size;
            $s->code = $key;
            $s->name = $value;
            $s->save();
        }
    }
}
