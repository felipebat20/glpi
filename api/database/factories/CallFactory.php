<?php

namespace Database\Factories;

use App\Models\Call;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CallFactory extends Factory
{
    protected $model = Call::class;

    public function definition()
    {
        $users = User::all()->where('user_type', 'user')->pluck('id')->toArray();
        $techs = User::all()->where('user_type', 'technician')->pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($users),
            'technician_id' => $this->faker->randomElement($techs),
            'action_id' => $this->faker->randomDigitNotNull(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(200),
            'filepath' => $this->faker->imageUrl(640, 480,'animals', true, 'cats'),
            'status' => $this->faker->numberBetween(1, 3),
            'severity' => $this->faker->numberBetween(1, 5),
            'urgency' => $this->faker->numberBetween(1, 5),
            'trend' => $this->faker->numberBetween(1, 5),
            'gut' => $this->faker->numberBetween(1, 5) * $this->faker->numberBetween(1, 5) * $this->faker->numberBetween(1, 5),
        ];
    }
}
