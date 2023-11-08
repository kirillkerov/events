<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User as User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->hasEvents(5)
            ->create();

        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => 'password',
        ]);
        //Event::factory(30)->create();
    }
}
