<?php

use App\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\SortOrdersByTime;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(15)->create();
        User::factory()->admin()->create();
        User::factory()->employee()->create();
        Category::factory(5)->create();
        Product::factory(10)->create();
        Order::factory(20)->create();
        SortOrdersByTime::factory(152)->breakfast();
        SortOrdersByTime::factory(225)->lunch();
        SortOrdersByTime::factory(295)->dinner();
        SortOrdersByTime::factory(152)->breakfast()->pickUp();
        SortOrdersByTime::factory(225)->lunch()->pickUp();
        SortOrdersByTime::factory(295)->dinner()->pickUp();
    }
}
