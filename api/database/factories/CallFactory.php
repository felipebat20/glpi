<?php

namespace Database\Factories;

use App\Models\Call;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class CallFactory extends Factory
{
    protected $model = Call::class;
    
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([2, 8, 9, 10]),
            'technician_id' => $this->faker->randomElement([3, 5, 6, 7]),
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
