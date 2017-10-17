<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateProductsTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    public function guests_may_not_add_products()
    {
        $this->withExceptionHandling();

        $this->post('/insertproduct')
            ->assertRedirect('/shop');

        $this->post('/shop/{slug}/photo')
            ->assertRedirect('/shop');
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
        $product = ['name' => 'toto', 'option_group_id' => '1', 'category_id' => '2', 'slug' => 'toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->withExceptionHandling();

        $user = factory('App\User')->make([
            'theboss' => 1,
            'employee' => 1
        ]);
        $this->be($user);
        $this->post('/insertproduct', $product)
            // ->assertRedirect('/restaurantpanel')
            ->assertSessionHas('success_message');
    }

    /** @test */
    function guests_may_not_add_photos_to_products()
    {
        $product = ['name' => 'toto', 'option_group_id' => '1', 'category_id' => '2', 'slug' => 'toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->withExceptionHandling();

        $photo = ['photos' => 'toto.jpg'];

        $this->post("/shop/{$product['slug']}/photo", $photo)
            ->assertRedirect('/shop');
    }

     /** @test */
    function any_auth_users_may_not_add_photos_to_products()
    {
        $product = ['name' => 'toto', 'option_group_id' => '1', 'category_id' => '2', 'slug' => 'toto', 'price' => 1900,
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
    //     $product = ['name' => 'toto', 'option_group_id' => '1', 'category_id' => '2', 'slug' => 'toto', 'price' => 1900,
    //         'description' => 'description', 'image' => 'image.jpg'];

    //    $user = factory('App\User')->make([
    //         'theboss' => 1,
    //         'employee' => 1
    //     ]);

    //     $this->be($user);
    //     $this->withExceptionHandling();

    //     $photo = ['photos' => 'toto.jpg'];
    //     $this->post('/insertproduct/', $product);
    //     $this->post("/shop/{{$product['slug']}}/photo", $photo)
    //         ->assertRedirect('/shop');
    // }

    /** @test */
    function guests_may_not_delete_a_product()
    {
        $product = ['name' => 'toto', 'option_group_id' => '1', 'category_id' => '2', 'slug' => 'toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->withExceptionHandling();

        $this->get('/delete/{{$product->slug}}')
            ->assertRedirect('/shop');
    }

    /** @test */
    function an_auth_user_may_not_delete_products()
    {
        $product = ['name' => 'toto', 'option_group_id' => '1', 'category_id' => '2', 'slug' => 'toto', 'price' => 1900,
            'description' => 'description', 'image' => 'image.jpg'];

        $this->signIn();

        $this->get('/delete/{{$product->slug}}')
            ->assertRedirect('/shop')
            ->assertSessionHas('error_message');
    }
}