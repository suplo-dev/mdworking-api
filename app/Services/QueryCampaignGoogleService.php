<?php

namespace App\Services;

use App\Enums\TableSearchEnum;
use App\Imports\AdsFacebookImport;
use App\Models\CampaignGoogle;
use App\Models\User;
use App\Repositories\AdsFacebookRepository;
use App\Repositories\AdsGoogleRepository;
use App\Repositories\CampaignGoogleRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class QueryCampaignGoogleService
{
    public function __construct(private readonly CampaignGoogleRepository $campaignGoogleRepository,
        private readonly AdsGoogleRepository $adsGoogleRepository,
    )
    {
    }

    public function search(array $params): LengthAwarePaginator
    {
        $params['per_page'] = data_get($params, 'per_page', TableSearchEnum::PER_PAGE->value);
        $params['page'] = data_get($params, 'page', TableSearchEnum::PAGE->value);
        $params['column'] = data_get($params, 'column', 'ended_at');
        $params['sort_order'] = data_get($params, 'sort_order', TableSearchEnum::SORT_ORDER_DESC->value);
        $params['started_at'] = data_get($params, 'started_at', Carbon::today()->startOfDay());
        $params['ended_at'] = data_get($params, 'ended_at', Carbon::today());

        return $this->campaignGoogleRepository->search($params);
    }

    public function add(array $params): bool
    {
        if (data_get($params, 'file')) {
            Excel::import(new AdsFacebookImport, $params['file']);
        }

        return true;
    }

    public function detail(array $params): array
    {
        $params['per_page'] = data_get($params, 'per_page', TableSearchEnum::PER_PAGE->value);
        $params['page'] = data_get($params, 'page', TableSearchEnum::PAGE->value);
        $params['column'] = data_get($params, 'column', 'name');
        $params['sort_order'] = data_get($params, 'sort_order', TableSearchEnum::SORT_ORDER_DESC->value);
        $params['started_at'] = data_get($params, 'started_at', Carbon::today()->startOfDay());
        $params['ended_at'] = data_get($params, 'ended_at', Carbon::today());
        $campaign = $this->campaignGoogleRepository->detail($params);
        $adsGoogles = $this->adsGoogleRepository->search($params);
        return ['campaign' => $campaign, 'ads_googles' => $adsGoogles];
    }

}
