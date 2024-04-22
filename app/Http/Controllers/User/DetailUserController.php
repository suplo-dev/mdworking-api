<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Resources\DetailUserResource;
use App\Models\User;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailUserController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(User $user, Request $request): JsonResponse
    {
        $data = $this->queryUserService->detail($user);

        return $this->responseData(new DetailUserResource($data));
    }
}
