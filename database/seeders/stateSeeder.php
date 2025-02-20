<?php

namespace Database\Seeders;
use App\Models\state;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class stateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('tbl_state')->delete();
        $state=([
           //us
            ['name' => 'California', 'country_id' => 1],
            ['name' => 'Texas', 'country_id' => 1],
            ['name' => 'Florida', 'country_id' => 1],
            ['name' => 'New York', 'country_id' => 1],
            //canada
            ['name' => 'Ontario', 'country_id' => 2],
            ['name' => 'Quebec', 'country_id' => 2],
            ['name' => 'British Columbia', 'country_id' => 2],
            ['name' => 'Alberta', 'country_id' => 2],
            //india
            ['name' => 'Maharashtra', 'country_id' => 100],
            ['name' => 'Delhi', 'country_id' => 100],
            ['name' => 'Gujarat', 'country_id' => 100],
            ['name' => 'Uttrakhand', 'country_id' => 100],
            ['name' => 'Karnataka', 'country_id' => 100],
            ['name' => 'Tamil Nadu', 'country_id' => 100],
            ['name' => 'Rajastan', 'country_id' => 100],

            // Australia States
            ['name' => 'New South Wales', 'country_id' =>15],
            ['name' => 'Victoria', 'country_id' => 15],
            ['name' => 'Queensland', 'country_id' => 15],
            ['name' => 'Western Australia', 'country_id' =>15],
            //bagaladesh

            ['name' => 'Dhaka', 'country_id' =>20],
            ['name' => 'Barisal', 'country_id' => 20],
            ['name' => 'Khulna', 'country_id' => 20],
            ['name' => 'Rangpur', 'country_id' =>20],
        
        ]);
        DB::table('tbl_state')->insert($state);
    }
}
