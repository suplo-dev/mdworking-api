<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsFacebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status',
        'type',
        'result',
        'reach',
        'impression',
        'amount_spent',
        'started_at',
        'ended_at',
    ];
}
