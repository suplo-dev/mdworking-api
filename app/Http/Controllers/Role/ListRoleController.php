<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Services\QueryRoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListRoleController extends Controller
{
    public function __construct(private readonly QueryRoleService $queryRoleService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = $this->queryRoleService->all();

        return $this->responseData($data);
    }
}
