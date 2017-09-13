<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RoutesTest extends TestCase
{
    use DatabaseMigrations;

     /** @test */
    function any_user_may_not_navigate_admin_pages()
    {
        $response = $this->get('/');
        $response->assertRedirect('/shop');

        $this->withExceptionHandling();

        $this->get('/restaurantpanel')
            ->assertRedirect('/login');

        $this->get('/panel')
            ->assertRedirect('/login');

        $this->get('/search-orders')
            ->assertRedirect('/login');

        $this->get('/livesearch')
            ->assertRedirect('/login');

        $this->get('/customer-orders')
            ->assertRedirect('/login');

        $this->get('/order/{id}')
            ->assertRedirect('/login');

        $this->get('/print/{id}')
            ->assertRedirect('/login');
    }

    /** @test */
    function auth_users_may_not_navigate_admin_pages()
    {
        $this->signIn();

        $this->get('/restaurantpanel')
            ->assertRedirect('/shop');

        $this->get('/panel')
            ->assertRedirect('/shop');

        $this->get('/search-orders')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->get('/livesearch')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->get('/customer-orders')
            ->assertRedirect('/shop');

        $order = create('App\Order');

        $this->get('/order/'.$order->id)
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->get('/print/{id}')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');
    }
}
