<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $discounts = [
            ['code_discount' => 'DISC10', 'rate_discount' => 10],
            ['code_discount' => 'DISC20', 'rate_discount' => 20],
            ['code_discount' => 'DISC30', 'rate_discount' => 30],
            ['code_discount' => 'DISC40', 'rate_discount' => 40],
            ['code_discount' => 'DISC50', 'rate_discount' => 50],
            ['code_discount' => 'DISC60', 'rate_discount' => 60],
        ];

        Discount::insert($discounts);
    }
}
