<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => '家具'],
            ['category_name' => '家電'],
            ['category_name' => '自転車'],
            ['category_name' => '車のパーツ'],
            ['category_name' => 'バイク'],
            ['category_name' => '楽器'],
            ['category_name' => 'チケット'],
            ['category_name' => '生活雑貨'],
            ['category_name' => '子供用品'],
            ['category_name' => 'おもちゃ'],
            ['category_name' => 'スポーツ'],
            ['category_name' => 'パソコン'],
            ['category_name' => '携帯/スマホ'],
            ['category_name' => '本/CD/DVD'],
            ['category_name' => '服/ファッション'],
            ['category_name' => '靴/バッグ'],
            ['category_name' => 'コスメ/ヘルスケア'],
            ['category_name' => '食品'],
            ['category_name' => 'お酒'],
            ['category_name' => 'グッツ'],
            ['category_name' => 'その他']
            
        ]);
    }
}
