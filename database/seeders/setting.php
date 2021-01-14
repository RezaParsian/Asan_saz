<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert(
            [
                [
                    "key" => "about",
                    "value" => "this api make by reza_atom"
                ],
                [
                    "key" => "logo",
                    "value" => "https://rp76.ir/favicon.ico"
                ]
            ]
        );
    }
}
