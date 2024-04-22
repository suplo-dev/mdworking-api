<?php

namespace App\Repositories;

use App\Enums\PermissionEnum;
use App\Models\AdsFacebook;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class AdsFacebookRepository extends BaseRepository
{
    public function model(): string
    {
        return AdsFacebook::class;
    }

    public function search(array $params): LengthAwarePaginator
    {
        $user = request()->user();
        return $this->model->query()
            ->select('user_id','name','status','type',
                DB::raw('SUM(result) as result'),
                DB::raw('SUM(reach) as reach'),
                DB::raw('SUM(impression) as impression'),
                DB::raw('SUM(amount_spent) as amount_spent'),
                DB::raw('(SUM(amount_spent)/SUM(result)) as cost_per_result'),
                'ended_at')
            ->when(data_get($params, 'keyword'), function ($q, $keyword){
                $q->where('name', 'like', "%$keyword%");
            })
            ->when(data_get($params, 'started_at'), function ($q, $startDateTime){
                $q->where('started_at', '>=', $startDateTime);
            })
            ->when(data_get($params, 'ended_at'), function ($q, $endDateTime){
                $q->where('started_at', '<=', $endDateTime);
            })
            ->when(!$user->hasAnyPermission([PermissionEnum::ADD_ADS_FB->value, PermissionEnum::UPDATE_ADS_FB->value]), function ($q) use ($user){
                $q->where('user_id', '=', $user->id);
            })
            ->havingNotNull('type')
            ->orderBy($params['column'], $params['sort_order'])
            ->groupBy('user_id', 'name', 'status', 'type', 'ended_at')
            ->paginate(perPage: $params['per_page'], page: $params['page']);
    }

    public function add(array $params): AdsFacebook|Builder
    {
//        $user = $this->model->query()->create([...$params, 'password' => bcrypt('123456')]);
//        $user->syncPermissions(data_get($params, 'permissions'));
//        $user->syncRoles(data_get($params, 'role'));
//        return $user;
    }
//
//    public function detail(AdsFacebook $user): AdsFacebook
//    {
//        return $user->load('roles:id,name');
//    }
//
//    public function update(AdsFacebook $user, array $params): bool
//    {
//        $user->syncPermissions(data_get($params, 'permissions'));
//        $user->syncRoles(data_get($params, 'role'));
//        return $user->update($params);
//    }

}
