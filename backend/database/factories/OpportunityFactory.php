<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Pipeline;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Opportunity>
 */
class OpportunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'contact_id' => $this->faker->randomElement(Contact::all()->pluck('id')),
            'manager_id' => $this->faker->randomElement(User::all()->pluck('id')),
            'creator_id' => $this->faker->randomElement(User::all()->pluck('id')),
            'pipeline_id' => $this->faker->randomElement(Pipeline::all()->pluck('id')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
