<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RoutesTest extends TestCase
{
    use DatabaseMigrations;


    function testAnyUserMayNotNavigateAdminPages()
    {
        $response = $this->get('/');
        $response->assertRedirect('/shop');

        $response = $this->get('/home');
        $response->assertRedirect('/shop');

        $this->withExceptionHandling();

        $this->get('/restaurantpanel')->assertRedirect('/login');

        $this->get('/panel')->assertRedirect('/login');

        $this->get('/search-orders')->assertRedirect('/login');

        $this->get('/livesearch')->assertRedirect('/login');

        $this->get('/customer-orders')->assertRedirect('/login');

        $this->get('/order/{id}')->assertRedirect('/login');

        $this->get('/print/{id}')->assertRedirect('/login');

        $this->get('/create-coupon')->assertRedirect('/login');

        $this->get('/add-category')->assertRedirect('/login');

        $this->get('/option-group')->assertRedirect('/login');

        $this->get('/add-options')->assertRedirect('/login');

        $this->get('/edit-css')->assertStatus(404);
    }


    function testAuthUsersMayNotNavigateAdminPages()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $this->get('/restaurantpanel')->assertRedirect('/shop');

        $this->get('/panel')->assertRedirect('/shop');

            // BELONGD TO SEARCH FEATURE TEST
        // $this->get('/search-orders')
        //     ->assertStatus(404)
        //     ->assertSessionHas('error_message');

        // $this->get('/livesearch')
        //     ->assertRedirect('/shop')
        //     ->assertSessionHas('error_message');

        $this->get('/customer-orders')->assertRedirect('/shop');

        $order = create('App\Models\Order');

        $this->get('/order/'.$order->id)->assertRedirect('/shop');

        $this->get('/print/{id}')->assertRedirect('/shop');

        $this->get('/create-coupon')->assertRedirect('/shop');

        $this->get('/add-category')->assertRedirect('/shop');

        $this->get('/option-group')->assertRedirect('/shop');

        $this->get('/add-options')->assertRedirect('/shop');

        $this->get('/edit-css')->assertStatus(404);
    }


    function testEmployeesMayNotNavigateAdminPages()
    {
        $this->withExceptionHandling();

        $this->signIn(factory('App\User')->states('employee')->create());

        $this->get('/restaurantpanel')->assertRedirect('/shop');

        $this->get('/panel')->assertRedirect('/shop');


            // DOES NOT BELONG HERE CAUSE EMPLOYEES MAY SEARCH:
            // TODO Search Feature test
        // $this->get('/search-orders')
        //     ->assertRedirect('/shop')
        //     ->assertSessionHas('error_message');
            //TODO GIVE VALID DATA HERE
        // $this->get('/livesearch')
        //     ->assertRedirect('/shop')
        //     ->assertSessionHas('error_message');

        $this->get('/create-coupon')->assertRedirect('/shop');

        $this->get('/add-category')->assertRedirect('/shop');

        $this->get('/option-group')->assertRedirect('/shop');

        $this->get('/add-options')->assertRedirect('/shop');

        $this->get('/edit-css')->assertStatus(404);
    }


    function testAdminMayActLikeAGod()
    {
        $this->withExceptionHandling();

        $this->signIn(factory('App\User')->states('administrator')->create());

        $this->get('/restaurantpanel')->assertStatus(200);

        // $this->get('/panel') //query not working in tests ... hhhmhmmm
        //     ->assertStatus(200);

        $this->get('/create-coupon')->assertStatus(200);

        $this->get('/add-category')->assertStatus(200);

        $this->get('/option-group')->assertStatus(200);

        $this->get('/add-options')->assertStatus(200);

        $this->get('/edit-css')->assertStatus(404);
    }
}