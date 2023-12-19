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

        $totalIncomeByMonthAndYear = Income::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('amount');

        $totalExpenseByMonthAndYear = Expense::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('amount');
            
        $monthBalance = $totalIncomeByMonthAndYear - $totalExpenseByMonthAndYear;

        $monthTotalSpentByCategory = Expense::join('categories as c', 'c.id', '=', 'expenses.category_id')
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->selectRaw('SUM(expenses.amount) as amount, c.description')
            ->groupBy('expenses.category_id', 'c.description')
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


// select sum(e.amount) as amount, c.description from expenses e 
// inner join categories c ON c.id = e.category_id
// group by e.category_id, c.description

