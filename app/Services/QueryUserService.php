<?php

namespace App\Services;

use App\Enums\TableSearchEnum;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class QueryUserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function search(array $params): LengthAwarePaginator
    {
        $params['per_page'] = data_get($params, 'per_page', TableSearchEnum::PER_PAGE->value);
        $params['page'] = data_get($params, 'page', TableSearchEnum::PAGE->value);
        $params['column'] = data_get($params, 'column', TableSearchEnum::COLUMN->value);
        $params['sort_order'] = data_get($params, 'sort_order', TableSearchEnum::SORT_ORDER->value);

        return $this->userRepository->search($params);
    }

    public function add(array $params): Model|Builder
    {
        return $this->userRepository->add($params);
    }

    public function detail(User $user): User
    {
        return $this->userRepository->detail($user);
    }

    public function update(User $user, array $params): bool
    {
        return $this->userRepository->update($user, $params);
    }

    public function updateProfile(array $params): bool|int
    {
        return $this->userRepository->updateProfile($params);
    }
}
