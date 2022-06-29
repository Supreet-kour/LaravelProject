<?php

namespace Tests\Unit;
use App\Models\Client;
use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_UserShouldBeRedirectedToLoginPageIfUserVisitsUserDashboardWithoutLoggingIn()
    {
        $response = $this->get('user/dashboard');

        $response->assertStatus(302);
    }

    public function test_UserloginAndViewDashboard()
    {
        //create user
        $user = User::factory()->create();
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/user/dashboard');

        $response->assertStatus(200);
    }

    public function test_UserCanViewContactFormThatTheyHaveSubmitted()
    {
        //create user
        $user = User::factory()->create();
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/user/dashboard');

        $response->assertStatus(200);

        $client = Client::factory()->create();
        $client->user_id = $user->id;
        $client->email = $user->email;
        $client->save();

        $response = $this->get( '/contact-form');
        $response->assertStatus(200);

    }

    public function test_UserCanEditContactFormThatTheyHaveSubmitted()
    {
        //create user
        $user = User::factory()->create();
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/user/dashboard');

        $response->assertStatus(200);

        $client = Client::factory()->create()->id;
        $response = $this->get('edit-detail/'. $client);
        $response->assertStatus(200);
    }

    public function test_UserCanDeleteContactFormThatTheyHaveSubmitted()
    {
        //create user
        $user = User::factory()->create();
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/user/dashboard');

        $response->assertStatus(200);

        $client = Client::factory()->create()->id;
        $response = $this->get('delete-detail/'. $client);
        $response->assertRedirect('contact-form');
    }
}
