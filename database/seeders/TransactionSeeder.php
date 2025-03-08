<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyData = [
            'UI UX',
            'Web Development',
            'Data Science',
            'Digital Marketing',
            'Graphic Design',
            'Cyber Security'
        ];

        foreach ($dummyData as $class) {
            Transaction::create([
                'transaction_code' => 'Dev-' . Str::random(8),
                'user_id' => rand(1, 3),
                'name_class' => $class,
                'type_class' => 'Berbayar',
                'price' => rand(500000, 10000000), // Antara 500rb - 10 juta
                'status' => 'pending',
                'snap_token' => Str::random(16)
            ]);
        }

    }
}
