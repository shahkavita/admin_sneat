<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class countrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('country')->insert([
            ["name"=>"USA"],
            ["name"=>"UK"],
            ["name"=>"India"],
            ["name"=>"China"],
        ]);
    }
}
