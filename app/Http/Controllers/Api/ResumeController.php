<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Resume\ResumeFindService;

class ResumeController extends Controller
{
    public function __construct(private ResumeFindService $resumeFindService)
    {
    }

    public function getResumeByYearAndMonth(int $year, int $month): JsonResponse
    {
        return $this->resumeFindService->getResumeByYearAndMonth($year, $month);
    }
}
