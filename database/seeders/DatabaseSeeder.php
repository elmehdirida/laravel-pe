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
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'el mehdi rida',
            'email' => 'rida@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
         ]);
            \App\Models\Order::factory(10)->create();
            \App\Models\Payment::factory(10)->create();
            \App\Models\Category::factory(10)->create();
            \App\Models\Discount::factory(10)->create();
            \App\Models\Product::factory(10)->create();
            \App\Models\Comment::factory(10)->create();
            \App\Models\OrderProduct::factory(10)->create();

    }

}
