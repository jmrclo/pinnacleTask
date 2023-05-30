<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $currentYear = date('Y-m-d');

        return [
            
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(2),
           'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
           'end_date' => $this->faker->date($currentYear),
          
        ];
    }
}
