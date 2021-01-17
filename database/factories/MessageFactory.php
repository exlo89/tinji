<?php

namespace Database\Factories;

use App\Models\TinjiMatch;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /** @var TinjiMatch $match */
        $match = TinjiMatch::all()->random();
        return [
            'match_id' => $match,
            'from_id' => $this->faker->boolean ? $match->host_id : $match->client_id,
            'message' => $this->faker->text,
            'seen' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->subMonth(), Carbon::now()->addMonth())
        ];
    }
}
