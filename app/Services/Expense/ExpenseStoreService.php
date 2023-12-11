<?php

namespace App\Services\Expense;

use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Services\Category\CategoryFindService;

class ExpenseStoreService
{
    public const DEFAULT_CATEGORY_WHEN_NOT_SET = 'Others';

    public function __construct(private CategoryFindService $categoryFindService)
    {
    }

    public function store(Request $request)
    {

        $expenseParameters = $request->all();

        if (!isset($expenseParameters['category_id'])) {

            $defaultCategory = $this
                ->categoryFindService
                ->findByDescription(self::DEFAULT_CATEGORY_WHEN_NOT_SET);

            $expenseParameters['category_id'] = $defaultCategory->id;
        }

        $expense = Expense::create($expenseParameters);
        return new ExpenseResource($expense);
    }
}
