<?php

namespace Database\Factories;

use App\Models\TinjiMatch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TinjiMatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TinjiMatch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'host_id' => User::all()->random(),
            'client_id' => User::all()->random(),
            'client_accept' => $this->faker->boolean
        ];
    }
}
