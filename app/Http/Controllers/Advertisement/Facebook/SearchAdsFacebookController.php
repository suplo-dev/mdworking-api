<?php

namespace App\Http\Controllers\Advertisement\Facebook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisement\Facebook\SearchAdsFacebookRequest;
use App\Http\Requests\Advertisement\Facebook\SearchAdsGoogleRequest;
use App\Services\QueryAdsFacebookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchAdsFacebookController extends Controller
{
    public function __construct(private readonly QueryAdsFacebookService $queryAdsFacebookService)
    {
    }

    public function __invoke(SearchAdsFacebookRequest $searchAdsFacebookRequest): JsonResponse
    {
        $data = $this->queryAdsFacebookService->search($searchAdsFacebookRequest->all());

        return $this->responseData($data);
    }
}
