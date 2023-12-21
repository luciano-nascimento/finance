<?php

namespace Database\Seeders;

use App\Models\Category;
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

        $categories = [
            'Food',
            'Health',
            'Housing',
            'Transport',
            'Education',
            'Leisure',
            'Unforeseen events',
            'Others'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                [
                    'description' => $category,
                ],
                [
                    'created_at' => Carbon::now()->toDateTimeString()
                ]
            );
        }
    }
}
