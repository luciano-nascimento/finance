<?php

namespace App\Services\Expense;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Resources\ExpenseResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpenseFindService
{
    public const ACCEPTED_URL_PARAMETERS = ['description'];

    public function getAll(Request $request): AnonymousResourceCollection
    {
        $expenses = Expense::query();

        foreach ($request->query() as $key => $value) {
            if (in_array($key, self::ACCEPTED_URL_PARAMETERS)) {
                $expenses->where($key, 'like', $value.'%');
            }
        }

        return ExpenseResource::collection(
            $expenses->with('category')->get()
        );
    }

    public function indexByYearAndMonth(int $year, int $month): AnonymousResourceCollection
    {
        $expenses = Expense::whereYear('date', (string)$year)
               ->whereMonth('date', (string)$month)
               ->get();

        return ExpenseResource::collection(
            $expenses
        );
    }
}
