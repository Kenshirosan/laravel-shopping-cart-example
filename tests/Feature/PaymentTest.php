<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauth_users_can_not_order()
    {
        $this->withExceptionHandling();

        $order = create('App\Order');

        $this->post('/order')
            ->assertRedirect('/login');
    }

    /** @test */
    function auth_users_can_not_order_anything_below_15_dollars()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $order = create('App\Order');
        $this->post('/order', $order->toArray())
            ->assertSessionHas(['error_message' => 'Your cart is empty !']);
    }
}
