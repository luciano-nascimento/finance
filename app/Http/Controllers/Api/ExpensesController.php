<?php

namespace App\Http\Controllers\Api;

use App\Services\Expense\ExpenseStoreService;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Controllers\Controller;
use App\Models\Expense;

class ExpensesController extends Controller
{
    public function __construct(private ExpenseStoreService $expenseStoreService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
        return ExpenseResource::collection($expenses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {
        $this->expenseStoreService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        return new ExpenseResource($expense);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());
        return new expenseResource($expense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return response(null, 204);
    }
}
