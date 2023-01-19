<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'question' => $this->faker->text,
            'answer1' => $this->faker->realText(20),
            'answer2' => $this->faker->realText(20),
            'answer3' => $this->faker->realText(20),
            'answer4' => $this->faker->realText(20),
            'correct_answer' => $this->faker->numberBetween(1, 4),
            'subject_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
