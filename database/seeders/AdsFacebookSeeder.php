<?php

namespace Database\Seeders;

use App\Models\AdsFacebook;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdsFacebookSeeder extends Seeder
{


    public function run(): void
    {
//        AdsFacebook::create([
//            'user_id' => 2,
//            'name' => 'Amela T3',
//            'status' => true,
//            'type' => 1,
//            'result' => 20,
//            'reach' => 80,
//            'impression' => 290,
//            'amount_spent' => 300000,
//            'started_at' => '2024-04-16',
//            'ended_at' => '2024-04-17',
//        ]);
        AdsFacebook::factory(1000)->create();
    }
}
