<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MstGame;

class MstGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gameNames = [
            'Rainbow Six Siege - レインボーシックス　シージ',
            'Apex Legends - エーペックスレジェンズ',
            'League of Legends - リーグ・オブ・レジェンド',
            'Overwatch - オーバーウォッチ',
            'Among Us - アマング・アス',
            'MONSTER HUNTER: WORLD - モンスターハンター：ワールド',
            'Ark: Survival Evolved - アーク',
            'PlayerUnknowns BattleGrounds - PUBG',
            'Dead by Daylight - デッド バイ デイライト',
            'Call of Duty®: VANGUARD - コール オブ デューティ ヴァンガード',
            'Call of Duty®: Black Ops Cold War - コール オブ デューティ ブラックオプス コールドウォー',
            'Fortnite - フォートナイト',
        ];

        foreach($gameNames as $name) {
            MstGame::create([
                'game_name' => $name
            ]);
        }
    }
}
