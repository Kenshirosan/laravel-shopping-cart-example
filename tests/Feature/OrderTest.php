<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    function auth_user_may_not_show_an_order()
    {
    	$order = create('App\Order', ['user_id' => 2]);

        $this->signIn();
        $this->withExceptionHandling();

        $this->post('/show-order/'. $order->id, $order->toArray())
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');
    }

    /** @test */
    function auth_user_may_not_hide_an_order()
    {
        $order = create('App\Order', ['user_id' => 2]);

        $this->signIn();
        $this->withExceptionHandling();
        $this->post('/hide-order/'. $order->id, $order->toArray())
            ->assertStatus(404);
    }

    /** @test */
    function employees_may_hide_and_show_an_order()
    {
        $order = create('App\Order', ['user_id' => 1]);

        $this->withExceptionHandling();

        $user = factory('App\User')->make([
            'theboss' => 0,
            'employee' => 1
        ]);

        $this->be($user);

        $this->post('/hide-orders/'. $order->id, $order->toArray())
            ->assertSessionHas('success_message');

        $this->post('/show-order/'. $order->id, $order->toArray())
            ->assertSessionHas('success_message');
    }

    /** @test */
    function employees_may_deal_with_orders()
    {
        $user = factory('App\User')->make([
            'theboss' => 0,
            'employee' => 1
        ]);

        $this->be($user);
        $this->get('/customer-orders')
            ->assertStatus(200);

        $order = create('App\Order');

        $this->get('/order/'.$order->id)
            ->assertStatus(200);

        $this->get('/print/'.$order->id)
            ->assertStatus(200);

        $this->post('/hide-orders/'. $order->id, $order->toArray())
            ->assertSessionHas('success_message');

        $this->post('/show-order/'. $order->id, $order->toArray())
            ->assertSessionHas('success_message');
    }

    // /** @test */ How to test stripe ?
    // function users_may_order_anything()
    // {
    //     $user = create('App\User');
    //     $this->be($user);

    //     $order = create('App\Order');
    //     $this->post('/order', $order->toArray())
    //         ->assertSessionHas('success_message');

    // }
}