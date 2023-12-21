<?php

use App\Models\Expense;
use App\Models\Income;
use Database\Seeders\CategorySeeder;

uses(
    Tests\TestCaseSeed::class,
);

it('should return the right resume of expenses and income by year and month', function () {

    Expense::factory()->count(1)->create([
        'category_id' => 1,
        'amount' => 1000.10,
        'date' => '2023-11-10'
    ]);

    Income::factory()->count(1)->create([
        'amount' => 10000.00,
        'date' => '2023-11-10'
    ]);

    Income::factory()->count(1)->create([
        'amount' => 10000.00,
        'date' => '2023-11-10'
    ]);

    $response = $this->getJson('/api/resume/2023/11');

    $response
        ->assertStatus(200)
        ->assertJson([
            "total_income" => 20000,
            "total_expense" => 1000.1,
            "balance" => 18999.9,
            "total_spent_by_category" => [
                [
                    'amount' => 1000.1,
                    'description' => 'Food',
                ]
            ]
        ]);
});

it('should return resume of expenses and income by year and month when it has no registers', function () {

    $response = $this->getJson('/api/resume/2023/11');

    $response
        ->assertStatus(200)
        ->assertJson([
            "total_income" => 0,
            "total_expense" => 0,
            "balance" => 0,
            "total_spent_by_category" => [
            
            ]
        ]);
});