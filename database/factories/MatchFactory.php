<?php

namespace Database\Factories;

use App\Models\Match;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Match::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'host_id' => User::all()->random(),
            'client_id' => User::all()->random()
        ];
    }
}
