<?php

namespace App\Services;

use App\Enums\TableSearchEnum;
use App\Imports\AdsFacebookImport;
use App\Models\User;
use App\Repositories\AdsFacebookRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class QueryAdsFacebookService
{
    public function __construct(private readonly AdsFacebookRepository $adsFacebookRepository)
    {
    }

    public function search(array $params): LengthAwarePaginator
    {
        $params['per_page'] = data_get($params, 'per_page', TableSearchEnum::PER_PAGE->value);
        $params['page'] = data_get($params, 'page', TableSearchEnum::PAGE->value);
        $params['column'] = data_get($params, 'column', 'status');
        $params['sort_order'] = data_get($params, 'sort_order', TableSearchEnum::SORT_ORDER_DESC->value);
        $params['started_at'] = data_get($params, 'started_at', Carbon::today()->startOfDay());
        $params['ended_at'] = data_get($params, 'ended_at', Carbon::today());

        return $this->adsFacebookRepository->search($params);
    }

    public function add(array $params): bool
    {
        if (data_get($params, 'file')) {
            Excel::import(new AdsFacebookImport, $params['file']);
        }

        return true;
    }
//
//    public function detail(User $user): User
//    {
//        return $this->userRepository->detail($user);
//    }
//
//    public function update(User $user, array $params): bool
//    {
//        return $this->userRepository->update($user, $params);
//    }

}
