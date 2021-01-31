<?php

namespace Database\Seeders;

use App\Models\TinjiMatch;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->hasSetting()->create(['email' => 'admin@test.de']);
        User::factory(99)->hasSetting()->create();
        TinjiMatch::factory(100)->hasMessages(10, function (array $attributes, TinjiMatch $match) {
            return ['user_id' => (bool)random_int(0, 1) ? $match->host : $match->client];
        })->create();
    }
}
