<?php

namespace Database\Factories;

use App\Enums\JobStatus;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_title' => $this->faker->jobTitle(),
            'job_type_id' => JobType::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'level' => 'Senior',
            'description' => $this->faker->paragraphs(3, true),
            'how_apply' => $this->faker->paragraphs(2, true),
            'application_link' => $this->faker->url(),
            'compensation_min' => 70,
            'compensation_max' => 80,
            'allow_remote' => $this->faker->boolean(),
            'location' => $this->faker->city().' '. $this->faker->state(),
            'status' => JobStatus::PUBLISHED->value,
        ];
    }
}
