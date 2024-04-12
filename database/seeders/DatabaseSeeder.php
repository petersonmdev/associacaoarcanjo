<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(30)->create();

        \App\Models\User::factory()->create([
            'name' => 'Peterson Macedo',
            'email' => 'petersondmb@gmail.com',
            'password' => md5('123456789'),
        ]);

        \App\Repositories\VoluntaryRepository::create([
          'name' => 'Peterson Macedo Voluntário',
          'user_id' => 31,
          'email' => 'petersondmb@gmail.com',
          'driving' => 1,
        ]);
    }
}
