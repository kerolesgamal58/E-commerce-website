<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Database\Factories\UserFactory;
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
        // \App\Models\User::factory(10)->create();
        User::factory()->count(50)->create();
        $this->call([AdminSeeder::class]);
        Setting::create([
            'sitename' => 'www.kerolesgamal.com',
            'email' => 'gamalkeroles58@gmail.com',
            'description' => 'this is for testing',
        ]);
    }
}
