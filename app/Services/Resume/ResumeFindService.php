<?php

namespace App\Services\Resume;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResumeFindService
{
    public function getResumeByYearAndMonth(int $year, int $month): JsonResponse
    {

        $totalIncomeByMonthAndYear = Income::whereMonth('date', (string)$month)
            ->whereYear('date', (string)$year)
            ->sum('amount');

        $totalExpenseByMonthAndYear = Expense::whereMonth('date', (string)$month)
            ->whereYear('date', (string)$year)
            ->sum('amount');

        $monthBalance = $totalIncomeByMonthAndYear - $totalExpenseByMonthAndYear;

        $monthTotalSpentByCategory = Expense::join('categories as c', 'c.id', '=', 'expenses.category_id')
            ->whereMonth('date', (string)$month)
            ->whereYear('date', (string)$year)
            ->selectRaw('c.id, c.description, SUM(expenses.amount) as amount')
            ->groupBy('c.id', 'expenses.category_id', 'c.description')
            ->get();

        return response()
            ->json([
                'total_income' =>  $totalIncomeByMonthAndYear,
                'total_expense' =>  $totalExpenseByMonthAndYear,
                'balance' =>  $monthBalance,
                'total_spent_by_category' =>  $monthTotalSpentByCategory,
            ], Response::HTTP_OK);
    }
}