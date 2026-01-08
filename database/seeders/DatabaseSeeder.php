<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;
use App\Models\Product;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'demo',
            'email' => 'demo@gmail.com',
            'password' => 'demo1212',
        ]);

        Product::factory(20)->create();
        Customer::factory(15)->create();
        Order::factory(15)->create();
        OrderItems::factory(15)->create();
    }
}
