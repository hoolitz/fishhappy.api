<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UsersController
 */
class UsersControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $users = factory(Users::class, 3)->create();

        $response = $this->get(route('user.index'));

        $response->assertOk();
        $response->assertViewIs('users.index');
        $response->assertViewHas('users');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UsersController::class,
            'store',
            \App\Http\Requests\UsersStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;

        $response = $this->post(route('user.store'), [
            'name' => $name,
            'email' => $email,
        ]);

        $users = User::query()
            ->where('name', $name)
            ->where('email', $email)
            ->get();
        $this->assertCount(1, $users);
        $user = $users->first();

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('user.name', $user->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $user = factory(Users::class)->create();
        $user = factory(User::class)->create();

        $response = $this->delete(route('user.destroy', $user));

        $response->assertRedirect(route('users.index'));

        $this->assertDeleted($user);
    }
}
