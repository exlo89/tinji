<?php

namespace Database\Factories;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random(),
            'age_from' => $this->faker->numberBetween(18, 21),
            'age_to' => $this->faker->numberBetween(28, 30),
            'sex' => Arr::random(['male', 'female', 'other']),
        ];
    }
}
