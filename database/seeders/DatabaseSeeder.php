<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\students;
use App\Models\announcement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();
            $user = User::factory()->create([
                'studentID' => 'admin',
                'firstname' => 'admin',
                'lastname' => 'admin',
                'gender' => 'male',

                'age' => 18,
                'birthplace' => 'bul',
                'phone' => 12312312312,
                'email' => 'jmrcloo12@gmail.com',
                'password' =>  Hash::make('admin'),
            ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $user = User::factory()->create([
        //     'name' => 'john Matthew',
        //     'email' => 'john@gmail.com'
        // ]);
        students::factory(1)->create([

        
            'user_id' => $user->id,
           'created_at' => Carbon::now()->format('Y-m-d'),

           


        ]);


        announcement::factory(5)->create([
            'user_id' => $user->id
        ]);
//   students::create([

//             'firstname' => 'john',
//             'lastname' => 'matthew',
//             'gender' => 'male',
//             'birthplace' => 'tayabas quezon',
//             'contact' => '09085192226',
//             'email' => 'jmarcelo@schools.ph',
//             'address' => 'Bocaue bulacan'

//         ]);

    }
}
