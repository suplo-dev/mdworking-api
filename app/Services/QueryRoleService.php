<?php

namespace App\Services;

use App\Enums\TableSearchEnum;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class QueryRoleService
{
    public function __construct(private readonly RoleRepository $roleRepository)
    {
    }

    public function all(): Collection|array
    {
        return $this->roleRepository->all(['id', 'name']);
    }
}
