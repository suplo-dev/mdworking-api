<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Resources\DetailUserResource;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(ChangePasswordRequest $changePasswordRequest): JsonResponse
    {
        $data = $this->queryUserService->updateProfile($changePasswordRequest->validated());

        if (Auth::attempt(['email' => $changePasswordRequest->user()->email, 'password' => $changePasswordRequest->password])) {
            request()->session()->regenerate();
        };
        return $this->responseData(new DetailUserResource(request()->user()));
    }
}
