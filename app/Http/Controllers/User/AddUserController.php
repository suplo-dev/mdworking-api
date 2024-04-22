<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddUserController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(AddUserRequest $addRequest): JsonResponse
    {
        $data = $this->queryUserService->add($addRequest->validated());

        return $this->responseData($data);
    }
}
