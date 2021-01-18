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
                [
                    'parent'=>0,
                    'title'=>"سایر",
                    'img'=>"favicon.ico",
                    'show '=>"Yes",
                    'olaviyat'=>"1",
                ],
            ]
            );
    }
}
