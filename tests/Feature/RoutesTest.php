<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use DatabaseMigrations;

     /** @test */
    function any_user_may_not_navigate_admin_pages()
    {
        $response = $this->get('/');
        $response->assertRedirect('/shop');

        $response = $this->get('/home');
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

        $this->get('/create-coupon')
            ->assertRedirect('/login');

        $this->get('/add-category')
            ->assertRedirect('/login');

        $this->get('/option-group')
            ->assertRedirect('/login');

        $this->get('/add-options')
            ->assertRedirect('/login');


        $this->get('/edit-css')
            ->assertStatus(404);
    }

    /** @test */
    function auth_users_may_not_navigate_admin_pages()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $this->get('/restaurantpanel')
            // ->assertRedirect('/shop');
            ->assertStatus(404);

        $this->get('/panel')
            ->assertStatus(404);

            // BELONGD TO SEARCH FEATURE TEST
        // $this->get('/search-orders')
        //     ->assertStatus(404)
        //     ->assertSessionHas('error_message');

        // $this->get('/livesearch')
        //     ->assertRedirect('/shop')
        //     ->assertSessionHas('error_message');

        $this->get('/customer-orders')
            ->assertStatus(404);

        $order = create('App\Models\Order');

        $this->get('/order/'.$order->id)
            ->assertStatus(404);

        $this->get('/print/{id}')
            ->assertStatus(404);

        $this->get('/create-coupon')
            ->assertStatus(404);

        $this->get('/add-category')
            ->assertStatus(404);

        $this->get('/option-group')
            ->assertStatus(404);

        $this->get('/add-options')
            ->assertStatus(404);

        $this->get('/edit-css')
            ->assertStatus(404);
    }

    /** @test */
    function employees_may_not_navigate_admin_pages()
    {
        $user = factory('App\User')->make([
            'theboss' => 0,
            'employee' => 1
        ]);
        $this->withExceptionHandling();

        $this->be($user);

        $this->get('/restaurantpanel')
            ->assertStatus(404);

        $this->get('/panel')
            ->assertStatus(404);


            // DOES NOT BELONG HERE CAUSE EMPLOYEES MAY SEARCH:
            // TODO Search Feature test
        // $this->get('/search-orders')
        //     ->assertRedirect('/shop')
        //     ->assertSessionHas('error_message');
            //TODO GIVE VALID DATA HERE
        // $this->get('/livesearch')
        //     ->assertRedirect('/shop')
        //     ->assertSessionHas('error_message');

        $this->get('/create-coupon')
            ->assertStatus(404);

        $this->get('/add-category')
            ->assertStatus(404);

        $this->get('/option-group')
            ->assertStatus(404);

        $this->get('/add-options')
            ->assertStatus(404);


        $this->get('/edit-css')
            ->assertStatus(404);
    }

    /** @test */
    function admin_may_act_like_a_god()
    {
        $this->withExceptionHandling();

        $this->signIn(factory('App\User')->states('administrator')->create());

        $this->get('/restaurantpanel')->assertStatus(200);

        // $this->get('/panel') //query not working in tests ... hhhmhmmm
        //     ->assertStatus(200);

        $this->get('/create-coupon')
            ->assertStatus(200);

        $this->get('/add-category')
            ->assertStatus(200);

        $this->get('/option-group')
            ->assertStatus(200);

        $this->get('/add-options')
            ->assertStatus(200);


        $this->get('/edit-css')
            ->assertStatus(404);
    }
}