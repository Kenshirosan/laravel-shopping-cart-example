<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauth_user_may_not_see_profile_page()
    {
        $this->withExceptionHandling();

        $this->get('/edit-profile')
            ->assertRedirect('/login');
    }

    /** @test */
    function a_user_may_see_his_profile()
    {
       $user = create('App\User');

       $this->be($user);

       $this->get('/edit-profile')
            ->assertSee($user->name);
    }

    /** @test */
    function a_user_may_edit_his_profile()
    {
        $user = create('App\User');

        $this->be($user);

        $this->post("/edit-profile/". $user->id, $user->toArray())
            ->assertRedirect('/edit-profile')
            ->assertSessionHas('success_message');
    }

    /** @test */
    function unauth_user_may_not_delete_their_profile()
    {
        $this->withExceptionHandling();

        $this->get('/erase/{user_id}')
            ->assertRedirect('/login');
    }

    /** @test */
    function auth_user_may_delete_their_profile()
    {
        $user = create('App\User');

        $this->be($user);

        $this->post('/erase/{account}', $user->toArray())
            ->assertRedirect('/register')
            ->assertSessionHas('success_message');
    }
}
