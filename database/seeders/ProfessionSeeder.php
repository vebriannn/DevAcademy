<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_professions')->insert([
            ['name' => 'Software Engineer', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Data Scientist', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'UI/UX Designer', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Project Manager', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
