<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Helpers\Helper;
use App\Models\students;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\students>
 */
class studentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $gender =$this->faker->randomElement(['male', 'female']);
        $currentYear = date('Y');
       

        $helperParams = array(
         'className' => new students,
         'column' => 'studentID',
         'prefix' => $currentYear.'A',
         'length' => 5
        );
        
        
        $studentID = Helper::IDGenerator($helperParams); /** Generate id */
        $q = new students;
        $q = $studentID;
        

        return [
            'studentID'=> $q,
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'gender' =>  $gender,
           'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'age' => 18,
            'birthplace' => $this->faker->city(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'address' => $this->faker->city(),
            
        ];
    }
}
