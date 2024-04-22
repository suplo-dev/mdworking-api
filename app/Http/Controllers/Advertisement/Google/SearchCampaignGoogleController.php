<?php

namespace App\Http\Controllers\Advertisement\Google;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisement\Google\SearchCampaignGoogleRequest;
use App\Models\CampaignGoogle;
use App\Services\QueryAdsFacebookService;
use App\Services\QueryCampaignGoogleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchCampaignGoogleController extends Controller
{
    public function __construct(private readonly QueryCampaignGoogleService $queryCampaignGoogleService)
    {
    }

    public function __invoke(SearchCampaignGoogleRequest $searchCampaignGoogleRequest): JsonResponse
    {
        $data = $this->queryCampaignGoogleService->search($searchCampaignGoogleRequest->all());

        return $this->responseData($data);
    }
}
