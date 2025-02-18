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
        $countries=[
            ['name'=>'United States','code'=>'US'],
            ['name'=>'United Kingdom','code'=>'UK'],
            ['name'=>'India','code'=>'IN'],
            ['name'=>'Australia','code'=>'AU'],
            ['name'=>'Germany','code'=>'DE'],
            ['name'=>'Canada','code'=>'CA'],
            ['name'=>'France','code'=>'FR'],
            ['name'=>'Japan','code'=>'JP'],
            ['name'=>'China','code'=>'CN'],
            ['name'=>'Brazil','code'=>'BR'],
        ];
        DB::table('country_tbl')->insert($countries);
    }
}
