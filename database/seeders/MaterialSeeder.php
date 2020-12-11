<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alls_izes = [
            'poplin' => 'поплин',
            'silk' => 'искусственный шелк',
            'satin' => 'микросатин',
            'poly' => 'ПЭ',
            'perkal' => 'перкаль',
            'zhakkard' => 'жаккард',
        ];

        foreach ($alls_izes as $key => $value) {
            $m = new Material;
            $m->code = $key;
            $m->name = $value;
            $m->save();
        }
    }
}
