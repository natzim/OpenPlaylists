<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        $faker = Faker\Factory::create();

        for ($i = 0; $i < 49; $i++)
        {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => bcrypt($faker->name)
            ]);
        }
    }

}