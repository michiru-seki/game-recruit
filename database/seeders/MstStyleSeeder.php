<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MstStyle;

class MstStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $styleNames = [
            'エンジョイ勢',
            'ガチ勢',
        ];

        foreach($styleNames as $name) {
            MstStyle::create([
                'style_name' => $name
            ]);
        }
    }
}
