<?php

namespace Database\Seeders;
use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $product=collect([
            [
                'name'=>'Electronics',
                'status'=>1
            ],
            [
                'name'=>'Food Product',
                'status'=>0
            ],
            [
                'name'=>'Home & Furniture',
                'status'=>1
            ]
            ]);
        $product->each(function ($p)
        {
            product::create($p);
        });
    }
}
