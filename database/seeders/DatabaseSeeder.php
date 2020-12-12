<?php

namespace Database\Seeders;

use App\Models\Match;
use App\Models\Message;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Boolean;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->hasSetting()->create();
        Match::factory(100)->hasMessages(10, function (array $attributes, Match $match) {
            return ['from_id' => (bool)random_int(0, 1) ? $match->host : $match->client];
        })->create();
    }
}
