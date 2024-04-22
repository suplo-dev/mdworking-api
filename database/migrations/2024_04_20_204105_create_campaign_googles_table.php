<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_googles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->tinyInteger('type')->nullable();
            $table->date('started_at');
            $table->date('ended_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'name', 'started_at'], 'unique_campaign_google');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_googles');
    }
};
