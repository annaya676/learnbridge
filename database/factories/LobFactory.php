<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lob>
 */
class LobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Lob::class;

    public function definition(): array
    {
        return [       
            'name' => $this->faker->text(50),
            'description' => $this->faker->text(100),
            'status' => 1,   
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    
}
