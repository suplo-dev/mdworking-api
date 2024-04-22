<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignGoogle extends Model
{
    use HasFactory;

    public function adsGoogle(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AdsGoogle::class, 'campaign_id');
    }
}
