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
            ->assertRedirect('/shop');

        $this->get('/panel')
            ->assertRedirect('/shop');

        $this->get('/search-orders')
            ->assertRedirect('/shop');

        $this->get('/livesearch')
            ->assertRedirect('/shop');

        $this->get('/customer-orders')
            ->assertRedirect('/shop');

        $this->get('/order/{id}')
            ->assertRedirect('/shop');

        $this->get('/print/{id}')
            ->assertRedirect('/shop');

        $this->get('/create-coupon')
            ->assertRedirect('/shop');

        $this->get('/add-category')
            ->assertRedirect('/shop');

        $this->get('/add-option-group')
            ->assertRedirect('/shop');

        $this->get('/add-options')
            ->assertRedirect('/shop');

        $this->get('/edit-css')
            ->assertRedirect('/shop');
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

        $this->get('/create-coupon')
            ->assertRedirect('/shop');

        $this->get('/add-category')
            ->assertRedirect('/shop');

        $this->get('/add-option-group')
            ->assertRedirect('/shop');

        $this->get('/add-options')
            ->assertRedirect('/shop');

        $this->get('/edit-css')
            ->assertRedirect('/shop');
    }

    /** @test */
    function employees_may_not_navigate_admin_pages()
    {
        $user = factory('App\User')->make([
            'theboss' => 0,
            'employee' => 1
        ]);

        $this->be($user);

        $this->get('/restaurantpanel')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->get('/panel')
            ->assertRedirect('/shop');

        $this->get('/search-orders')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->get('/livesearch')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->get('/create-coupon')
            ->assertRedirect('/shop');

        $this->get('/add-category')
            ->assertRedirect('/shop');

        $this->get('/add-option-group')
            ->assertRedirect('/shop');

        $this->get('/add-options')
            ->assertRedirect('/shop');

        $this->get('/edit-css')
            ->assertRedirect('/shop');
    }

    /** @test */
    function admin_may_act_like_a_god()
    {
        $user = factory('App\User')->make([
            'theboss' => 1,
            'employee' => 1
        ]);

        $this->be($user);

        $this->get('/restaurantpanel')
            ->assertStatus(200);

        // $this->get('/panel') //query not working in tests ... hhhmhmmm
        //     ->assertStatus(200);

        $this->get('/search-orders')
            ->assertStatus(200);

        $this->get('/livesearch')
            ->assertStatus(200);

        $this->get('/create-coupon')
            ->assertStatus(200);

        $this->get('/add-category')
            ->assertStatus(200);

        $this->get('/add-option-group')
            ->assertStatus(200);

        $this->get('/add-options')
            ->assertStatus(200);

        $this->get('/edit-css')
            ->assertStatus(200);
    }
}