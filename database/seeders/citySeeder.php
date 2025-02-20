<?php

namespace Database\Seeders;
use App\Models\city;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class citySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tbl_city')->delete();
        $city=([
           //california
            ['name' => 'Los Angeles', 'state_id' => 1],
            ['name' => 'San Francisco', 'state_id' => 1],
            ['name' => 'San Diego', 'state_id' => 1],
            //Florida
            ['name' => 'Miami', 'state_id' => 2],
            ['name' => 'Orlando', 'state_id' => 2],
           
            //ontario
            ['name' => 'Toronto', 'state_id' =>5],
         ['name' => 'London', 'state_id' =>5 ],
            ['name' => 'Ottawa', 'state_id' =>5],
            ['name' => 'Brampton', 'state_id' =>5 ],
            
            //Maharastra
            ['name' => 'Pune', 'state_id' => 9],
            ['name' => 'Mumbai', 'state_id' => 9],
            ['name' => 'Nashik', 'state_id' => 9],
            ['name' => 'Amravati', 'state_id' => 9],

            //Delhi
            ['name' => 'Delhi', 'state_id' => 10],

            //Gujarat
            ['name' => 'Ahmedabad', 'state_id' => 11],
            ['name' => 'Surat', 'state_id' => 11],
            ['name' => 'Vapi', 'state_id' => 11],
            ['name' => 'Baroda', 'state_id' => 11],
            ['name' => 'Navsari', 'state_id' => 11],
            ['name' => 'Gandhinagar', 'state_id' => 11],
            ['name' => 'Jamanagar', 'state_id' => 11],

            //uttrakhand
            ['name' => 'Dehradun', 'state_id' => 12],
            ['name' => 'Haridwar', 'state_id' => 12],
            ['name' => 'Rishikesh', 'state_id' => 12],
            ['name' => 'Roorkee', 'state_id' => 12],
            ['name' => 'Haldwani', 'state_id' => 12],
            ['name' => 'Nainital', 'state_id' => 12],
        
        ]);
        DB::table('tbl_city')->insert($city);
    
    }
}
