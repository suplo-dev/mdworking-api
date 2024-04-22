<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;

class UpdateProfileController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(UpdateProfileRequest $updateProfileRequest): JsonResponse
    {
        $data = $this->queryUserService->updateProfile($updateProfileRequest->validated());

        return $this->responseData($data);
    }
}
