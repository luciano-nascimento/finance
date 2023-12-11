<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert(
            [
                [
                    'description' => 'Food',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Health',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Housing',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Transport',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Education',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Leisure',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Unforeseen events',
                    'created_at' => Carbon::now()->toDateTimeString()
                ],
                [
                    'description' => 'Others',
                    'created_at' => Carbon::now()->toDateTimeString()
                ]
            ]
            
        );
    }
}
