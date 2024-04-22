<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Resources\DetailUserResource;
use App\Models\User;
use App\Services\QueryUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private readonly QueryUserService $queryUserService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return $this->responseData(new DetailUserResource($request->user()->load('roles')));
    }
}
