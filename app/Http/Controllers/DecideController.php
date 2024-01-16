<?php

namespace App\Http\Controllers;

use App\Http\Requests\DecideRequest;
use App\Http\Resources\RatingResourceCollection;
use App\Services\GetRatingService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DecideController extends Controller
{
    public function __construct(private readonly GetRatingService $getRatingService)
    {

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(DecideRequest $request)
    {
        $date = $request->query('date');
//        dump($date);
        return new JsonResponse(new RatingResourceCollection($this->getRatingService->getData($date)));

    }
}
