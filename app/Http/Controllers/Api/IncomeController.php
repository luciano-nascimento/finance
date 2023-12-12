<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Resources\IncomeResource;
use App\Models\Income;
use App\Services\Income\IncomeFindService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IncomeController extends Controller
{
    public function __construct(
        private IncomeFindService $incomeFindService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->incomeFindService->getAll($request);
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
    public function store(StoreIncomeRequest $request)
    {
        $income = Income::create($request->all());
        return new IncomeResource($income);
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        return new IncomeResource($income);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreIncomeRequest $request, Income $income)
    {
        $income->update($request->all());
        return new IncomeResource($income);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $income->delete();
        return response(null, 204);
    }

    public function indexByYearAndMonth(int $year, int $month): AnonymousResourceCollection
    {
        return $this->incomeFindService->indexByYearAndMonth($year, $month);
    }
}
