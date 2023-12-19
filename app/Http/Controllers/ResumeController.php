<?php

namespace App\Http\Controllers;

use App\Services\Resume\ResumeFindService;
use Illuminate\Http\JsonResponse;

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
