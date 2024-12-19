<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productSeason = [
            ['product_id' => 1, 'season_id' => 3],//キウイ秋
            ['product_id' => 1, 'season_id' => 4], //キウイ冬
            ['product_id' => 2, 'season_id' => 1], // イチゴ春
            ['product_id' => 3, 'season_id' => 4], // オレンジ冬
            ['product_id' => 4, 'season_id' => 2], // スイカ夏
            ['product_id' => 5, 'season_id' => 2], // ピーチ夏
            ['product_id' => 6, 'season_id' => 2], // シャインマスカット夏
            ['product_id' => 6, 'season_id' => 3], // シャインマスカット秋
            ['product_id' => 7, 'season_id' => 1], // パイナップル春
            ['product_id' => 7, 'season_id' => 2], // パイナップル夏
            ['product_id' => 8, 'season_id' => 2], // ブドウ夏
            ['product_id' => 8, 'season_id' => 3], // ブドウ秋
            ['product_id' => 9, 'season_id' => 2], // バナナ夏
            ['product_id' => 10, 'season_id' => 1], // メロン春
            ['product_id' => 10, 'season_id' => 2], // メロン夏
        ];

        DB::table('product_season')->insert($productSeason);
    }
}
