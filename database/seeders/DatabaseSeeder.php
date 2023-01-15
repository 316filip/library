<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Author::factory(1)->create([
            'name_prefix' => '',
            'first_name' => 'Neznámý',
            'middle_name' => '',
            'last_name' => 'autor',
            'name_suffix' => '',
            'birth_date' => NULL,
            'death_date' => NULL,
            'description' => ''
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Author::factory(10)->create();
        \App\Models\Work::factory(10)->create();
        \App\Models\Book::factory(10)->create();
        \App\Models\Booking::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Assignment::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
