<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'manager_id' => $this->faker->randomElement(User::all()->pluck('id')),
            'creator_id' => $this->faker->randomElement(User::all()->pluck('id')),
            'contact_id' => $this->faker->randomElement(Contact::all()->pluck('id')),
            'opportunity_id' => $this->faker->randomElement(Opportunity::all()->pluck('id')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
