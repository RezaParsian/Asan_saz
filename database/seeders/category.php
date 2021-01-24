<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert(
            [
                ['parent' => '0', 'title' => 'مواد خوراکی و نوشیدنی', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '1', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '0', 'title' => 'لوازم تحریر', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '2', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '0', 'title' => 'پروتویئن', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '3', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '1', 'title' => 'مواد خوراکی', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '1', 'title' => 'نوشیدنی ها', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '2', 'title' => 'خودکار', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '2', 'title' => 'دفتر', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '3', 'title' => 'گوشت قرمز', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '3', 'title' => 'مرغ', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '1', 'title' => 'چاشنی و افزودنی', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '4', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '10', 'title' => 'سس ها', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '10', 'title' => 'کنسرو ها', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '0', 'created_at' => NULL, 'updated_at' => NULL],
                ['parent' => '0', 'title' => 'فاینال', 'img' => 'favicon.png', 'show' => 'Yes', 'olaviyat' => '5', 'created_at' => NULL, 'updated_at' => NULL]
            ]
        );
    }
}
