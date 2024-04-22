<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(User $user, UpdateUserRequest $updateUserRequest): JsonResponse
    {
        $data = $this->queryUserService->update($user, $updateUserRequest->validated());

        return $this->responseData($data);
    }
}
