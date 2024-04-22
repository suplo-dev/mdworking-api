<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchUserController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = $this->queryUserService->search($request->all());

        return $this->responseData($data);
    }
}
