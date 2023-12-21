<?php

namespace App\Services\Income;

use App\Http\Resources\IncomeResource;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IncomeFindService
{
    public const ACCEPTED_URL_PARAMETERS = ['description'];

    public function getAll(Request $request): AnonymousResourceCollection
    {
        $income = Income::query();

        foreach ($request->query() as $key => $value) {
            if (in_array($key, self::ACCEPTED_URL_PARAMETERS)) {
                $income->where($key, 'like', $value.'%');
            }
        }

        return IncomeResource::collection(
            $income->get()
        );
    }

    public function indexByYearAndMonth(int $year, int $month): AnonymousResourceCollection
    {
        $income = Income::whereYear('date', (string)$year)
               ->whereMonth('date', (string)$month)
               ->get();

        return IncomeResource::collection(
            $income
        );
    }

}
