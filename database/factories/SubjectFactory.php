<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{

    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title,
            'exam_availability' => $this->faker->boolean,
            'exam_start_date' => $this->faker->date,
            'exam_deadline' => $this->faker->dateTime,
            'duration' => $this->faker->numberBetween(1, 20),
        ];
    }
}
