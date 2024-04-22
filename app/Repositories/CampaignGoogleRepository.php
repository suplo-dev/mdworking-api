<?php

namespace App\Repositories;

use App\Enums\PermissionEnum;
use App\Models\AdsGoogle;
use App\Models\CampaignGoogle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class CampaignGoogleRepository extends BaseRepository
{
    public function model(): string
    {
        return CampaignGoogle::class;
    }

    public function search(array $params): LengthAwarePaginator
    {
        $user = request()->user();
        return $this->model->query()
            ->with(['adsGoogle' => function ($q){
                $q->select('campaign_id',
                    DB::raw('SUM(click) as click'),
                    DB::raw('SUM(ctr) as ctr'),
                    DB::raw('SUM(amount_spent) as amount_spent'),
                    DB::raw('(SUM(amount_spent)/SUM(click)) as avg_cpc'));
                $q->groupBy('campaign_id');
            }])
            ->when(data_get($params, 'keyword'), function ($q, $keyword){
                $q->where('name', 'like', "%$keyword%");
            })
            ->when(data_get($params, 'started_at'), function ($q, $startDateTime){
                $q->where('started_at', '>=', $startDateTime);
            })
            ->when(data_get($params, 'ended_at'), function ($q, $endDateTime){
                $q->where('started_at', '<=', $endDateTime);
            })
            ->when(!$user->hasAnyPermission([PermissionEnum::ADD_ADS_GG->value, PermissionEnum::UPDATE_ADS_GG->value]), function ($q) use ($user){
                $q->where('user_id', '=', $user->id);
            })
            ->havingNotNull('type')
            ->orderBy($params['column'], $params['sort_order'])
            ->paginate(perPage: $params['per_page'], page: $params['page']);
    }

    public function detail(array $params)
    {
        $user = request()->user();
        return $this->model->query()
            ->with(['adsGoogle' => function ($q){
                $q->select('campaign_id',
                    DB::raw('SUM(click) as click'),
                    DB::raw('SUM(ctr) as ctr'),
                    DB::raw('SUM(amount_spent) as amount_spent'),
                    DB::raw('(SUM(amount_spent)/SUM(click)) as avg_cpc'));
                $q->groupBy('campaign_id');
            }])
            ->when(data_get($params, 'keyword'), function ($q, $keyword){
                $q->where('name', 'like', "%$keyword%");
            })
            ->when(data_get($params, 'started_at'), function ($q, $startDateTime){
                $q->where('started_at', '>=', $startDateTime);
            })
            ->when(data_get($params, 'ended_at'), function ($q, $endDateTime){
                $q->where('started_at', '<=', $endDateTime);
            })
            ->when(!$user->hasAnyPermission([PermissionEnum::ADD_ADS_GG->value, PermissionEnum::UPDATE_ADS_GG->value]), function ($q) use ($user){
                $q->where('user_id', '=', $user->id);
            })
            ->find(data_get($params, 'campaign_id'));
    }

}
