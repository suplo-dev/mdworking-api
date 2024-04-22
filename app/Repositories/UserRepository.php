<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function search(array $params): LengthAwarePaginator
    {
        return $this->model->query()
            ->when(data_get($params, 'keyword'), function ($q, $keyword){
                $q->where(function ($q) use ($keyword){
                    $q->where('name', 'like', "%$keyword%");
                    $q->orWhere('email', 'like', "%$keyword%");
                    $q->orWhere('phone', 'like', "%$keyword%");
                });
            })
            ->when(data_get($params, 'role'), function ($q, $role){
                $q->whereRelation('roles', 'id', '=', $role);
            })
            ->orderBy($params['column'], $params['sort_order'])
            ->paginate(perPage: $params['per_page'], page: $params['page']);
    }

    public function add(array $params): User|Builder
    {
        $user = $this->model->query()->create([...$params, 'password' => bcrypt('123456')]);
        $user->syncPermissions(data_get($params, 'permissions'));
        $user->syncRoles(data_get($params, 'role'));
        return $user;
    }

    public function detail(User $user): User
    {
        return $user->load('roles:id,name');
    }

    public function update(User $user, array $params): bool
    {
        $user->syncPermissions(data_get($params, 'permissions'));
        $user->syncRoles(data_get($params, 'role'));
        return $user->update($params);
    }

    public function updateProfile(array $params): bool|int
    {
        return $this->model->query()->find(request()->user()->id)->update($params);
    }
}
