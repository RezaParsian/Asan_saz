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
                [
                    "category" => "1",
                    "title" => "رب",
                    "action" => "Pay",
                    "price" => "25000",
                    "max" => "10",
                    "des" => "haji in ye teste",
                    "img" => 'favicon.ico',
                    "gallery" => '[
                        "1598559170.jpg",
                        "1596982940.jpg",
                        "1593427334.jpg"
                    ]',
                    "show" => "Yes",
                    "olaviyat" => "0",
                    "highrate" => "Yes"
                ],
                [
                    "category" => "1",
                    "title" => "تعمیر یخچال",
                    "action" => "one_click",
                    "price" => "25000",
                    "max" => "10",
                    "des" => "haji in ye teste 2",
                    "img" => 'favicon.png',
                    "gallery" => '[
                            "1596608403.jpg",
                            "1596608624.jpg",
                            "1596608550.jpg"
                        ]',
                    "show" => "Yes",
                    "olaviyat" => "2",
                    "highrate" => "Yes"
                ],
                [
                    "category" => "1",
                    "title" => "رب",
                    "action" => "Pay",
                    "price" => "25000",
                    "max" => "10",
                    "des" => "haji in ye teste",
                    "img" => 'favicon.ico',
                    "gallery" => '[
                                "1598559170.jpg",
                                "1596982940.jpg",
                                "1593427334.jpg"
                            ]',
                    "show" => "Yes",
                    "olaviyat" => "0",
                    "highrate" => "Yes"
                ],
                [
                    "category" => "1",
                    "title" => "تعمیر یخچال",
                    "action" => "one_click",
                    "price" => "25000",
                    "max" => "10",
                    "des" => "haji in ye teste 2",
                    "img" => 'favicon.png',
                    "gallery" => '[
                                    "1596608403.jpg",
                                    "1596608624.jpg",
                                    "1596608550.jpg"
                                ]',
                    "show" => "Yes",
                    "olaviyat" => "1",
                    "highrate" => "Yes"
                ]
            ]
        );
    }
}
