<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use App\Photo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateProductsTest extends TestCase
{
    use DatabaseMigrations;


    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function guests_may_not_add_products()
    {
        $this->withExceptionHandling();

        $this->post('/insertproduct')
            ->assertRedirect('/login');

        $this->post('/shop/{slug}/photo')
            ->assertRedirect('/login');
    }

    /** @test */
    public function any_auth_user_may_not_add_products()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $this->post('/insertproduct')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');

        $this->post('/shop/{slug}/photo')
            ->assertRedirect('/shop');
    }

    /** @test */
    function admin_may_add_a_product()
    {
        $product = ['name' => 'toto', 'category' => 'Appetizers', 'slug' => 'toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->withExceptionHandling();

        $user = factory('App\User')->make([
            'theboss' => 1,
            'employee' => 1
        ]);

        $this->actingAs($user);
        $this->post('/insertproduct/', $product)
            // ->assertRedirect('/restaurantpanel')
            ->assertSessionHas('success_message');
    }

    /** @test */
    function guests_may_not_add_photos_to_products()
    {
        $product = ['name' => 'toto', 'category' => 'Appetizers', 'slug' => 'toto-toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->withExceptionHandling();

        $photo = ['photos' => 'toto.jpg'];

        $this->post("/shop/{$product['slug']}/photo", $photo)
            ->assertRedirect('/login');
    }

     /** @test */
    function any_auth_users_may_not_add_photos_to_products()
    {
        $product = ['name' => 'toto', 'category' => 'Appetizers', 'slug' => 'toto-toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->signIn();
        $this->withExceptionHandling();
        $photo = ['photos' => 'toto.jpg'];

        $this->post("/shop/{$product['slug']}/photo", $photo)
            ->assertRedirect('/shop');
    }

      /** @test */
    // function admin_may_add_photos_to_products()
    // {
    //     $product = ['name' => 'toto', 'category' => 'Appetizers', 'slug' => 'toto-toto', 'price' => 1900,
    //         'description' => 'description', 'image' => 'image.jpg'];

    //    $user = factory('App\User')->make([
    //         'theboss' => 1,
    //         'employee' => 1
    //     ]);

    //     $this->be($user);
    //     $this->withExceptionHandling();

    //     $photo = ['photos' => '~/Pictures/toto.jpg'];
    //     $this->post('/insertproduct/', $product);
    //     $this->post("/shop/{$product['slug']}/photo", $photo)
    //         ->assertRedirect('/shop');
    // }

    /** @test */
    function guests_may_not_delete_a_product()
    {
        $this->withExceptionHandling();

        $this->get('/delete/{{$product->slug}}')
            ->assertRedirect('/login');
    }

    /** @test */
    function an_auth_user_may_not_delete_products()
    {
        $this->signIn();

        $this->get('/delete/{{$product->slug}}')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');
    }

    /** @test */
    function auth_user_may_not_hide_an_order()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $this->post('/hide-order')
            ->assertStatus(404);
    }

    /** @test */
    function auth_user_may_not_show_an_order()
    {
        $this->signIn();
        $this->withExceptionHandling();

        $this->post('/show-order')
            ->assertStatus(404);
    }

    /** @test */
    function admin_may_hide_and_show_an_order()
    {
        $order = create('App\Order', ['user_id' => 1]);

        $this->withExceptionHandling();

        $user = factory('App\User')->make([
            'theboss' => 1,
            'employee' => 1
        ]);

        $this->be($user);

        $this->post('/hide-orders/'. $order->id, $order->toArray())
            ->assertSessionHas('success_message');

        $this->post('/show-order/'. $order->id, $order->toArray())
            ->assertSessionHas('success_message');
    }
}
