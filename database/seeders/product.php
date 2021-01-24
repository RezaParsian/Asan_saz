<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert(
            [
                ['category' => '0', 'title' => 'تعمیر یخچال', 'action' => 'one_click', 'price' => '25000', 'max' => '10', 'des' => 'haji in ye teste 2', 'img' => 'favicon.png', 'gallery' => json_encode(["1596608403.jpg","1596608624.jpg","1596608550.jpg"]), 'show' => 'Yes', 'olaviyat' => '2', 'highrate' => 'Yes', 'created_at' => NULL, 'updated_at' => NULL],
                ['category' => '12', 'title' => 'تن ماهی', 'action' => 'pay', 'price' => '25000', 'max' => '10', 'des' => 'haji in ye teste', 'img' => 'favicon.ico', 'gallery' => json_encode(["1598559170.jpg","1596982940.jpg","1593427334.jpg"]), 'show' => 'Yes', 'olaviyat' => '1', 'highrate' => 'Yes', 'created_at' => NULL, 'updated_at' => NULL],
                ['category' => '9', 'title' => 'مرغ کامل', 'action' => 'pay', 'price' => '25000', 'max' => '10', 'des' => 'haji in ye teste', 'img' => 'favicon.ico', 'gallery' => json_encode(["1598559170.jpg","1596982940.jpg","1593427334.jpg"]), 'show' => 'Yes', 'olaviyat' => '0', 'highrate' => 'Yes', 'created_at' => NULL, 'updated_at' => NULL],
                ['category' => '0', 'title' => 'خدمات پکیج', 'action' => 'one_click', 'price' => '25000', 'max' => '10', 'des' => 'haji in ye teste 2', 'img' => 'favicon.png', 'gallery' => json_encode(["1596608403.jpg","1596608624.jpg","1596608550.jpg"]), 'show' => 'Yes', 'olaviyat' => '0', 'highrate' => 'Yes', 'created_at' => NULL, 'updated_at' => NULL],
                ['category' => '9', 'title' => 'ران مرغ', 'action' => 'pay', 'price' => '25000', 'max' => '10', 'des' => 'haji in ye teste', 'img' => 'favicon.ico', 'gallery' => json_encode(["1598559170.jpg","1596982940.jpg","1593427334.jpg"]), 'show' => 'Yes', 'olaviyat' => '1', 'highrate' => 'Yes', 'created_at' => NULL, 'updated_at' => NULL],
                ['category' => '0', 'title' => 'خدمات برق', 'action' => 'one_click', 'price' => '25000', 'max' => '10', 'des' => 'haji in ye teste', 'img' => '', 'gallery' => json_encode([]), 'show' => 'Yes', 'olaviyat' => '3', 'highrate' => 'Yes', 'created_at' => NULL, 'updated_at' => NULL]
            ]
        );
    }
}
