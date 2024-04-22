<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(AdsFacebookSeeder::class);
        $this->call(CampaignGoogleSeeder::class);
        $this->call(AdsGoogleSeeder::class);
    }
}
