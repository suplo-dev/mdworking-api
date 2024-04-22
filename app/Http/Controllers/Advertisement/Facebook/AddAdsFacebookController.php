<?php

namespace App\Http\Controllers\Advertisement\Facebook;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertisement\Facebook\AddAdsFacebookRequest;
use App\Http\Requests\Advertisement\Facebook\AddAdsGoogleRequest;
use App\Http\Requests\User\AddUserRequest;
use App\Services\QueryAdsFacebookService;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddAdsFacebookController extends Controller
{
    public function __construct(private readonly QueryAdsFacebookService $queryAdsFacebookService)
    {
    }

    public function __invoke(AddAdsFacebookRequest $addAdsFacebookRequest): JsonResponse
    {
        $data = $this->queryAdsFacebookService->add($addAdsFacebookRequest->validated());

        return $this->responseData($data);
    }
}
