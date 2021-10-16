<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [

            'name' => $this->faker->valid(function ($string) { return \Illuminate\Support\Str::length($string) <= 15; })->userName,
            'email' => $this->faker->unique()->email,
            'password' => \Illuminate\Support\Facades\Hash::make("tryhitme"),
            'email_verified_at' => null,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function confirm()
    {
        return $this->state(function ($attributes) {

            return [

                'email_verified_at' => \Illuminate\Support\Facades\Date::now(),
            ];
        });
    }
}