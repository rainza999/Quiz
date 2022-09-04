<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    $user = [
        [
            'name' => 'John Michael',
            'email' => 'john@quiz.com',
            'position' => 'Manager',
            'password' => bcrypt('123456')
        ],
        [
            'name' => 'Alexa Liras',
            'email' => 'alexa@quiz.com',
            'position' => 'Developer',
            'password' => bcrypt('123456')
        ],
        [
            'name' => 'Laurent Perrier',
            'email' => 'laurent@quiz.com',
            'position' => 'Projects Manager',
            'password' => bcrypt('123456')
        ]
        ];
        foreach($user as $key => $value){
            User::create($value);
        }

    }
}
