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
}
