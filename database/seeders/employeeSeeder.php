<?php

namespace Database\Seeders;
use App\Models\employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class employeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $s1=collect([
            [
                'name'=>'Ridhma Shani',
                'email'=>'ridhima123@gmail.com',
                'gender'=>'Female',
                'department'=>'Sales',
                'skills'=>'Communication'
            ],
            [
                'name'=>'Rochak Shani',
                'email'=>'rochak123@gmail.com',
                'gender'=>'Male',
                'department'=>'Accounts',
                'skills'=>'Time Mangement'
            ]
            ]);
        $s1->each(function ($d)
        {
            employee::create($d);
        });
    }
}
