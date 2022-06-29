<?php

namespace Tests\Unit;
use App\Models\Client;
use App\Models\User;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_AdminShouldBeRedirectedToLoginPageIfAdminVisitsAdminDashboardWithoutLoggingIn()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(302);
    }

    public function test_AdminloginAndViewDashboard()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_AdminViewAgentDashboard()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('admin/agent/dashboard');

        $response->assertStatus(200);
    }

    public function test_AdminCanViewAllContactForm()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('admin/agent/dashboard');

        $response->assertStatus(200);

        $client = new Client();
        $client = Client::all();

        $response = $this->get('admin/agent/client');
        $response->assertStatus(200);

    }

    public function test_AdminCanEditContactForm()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('admin/agent/dashboard');

        $response->assertStatus(200);

        $client = Client::factory()->create()->id;
        $response = $this->get('/admin/agent/edit-detail/'. $client);
        $response->assertStatus(200);
    }

    public function test_AdminCanDeleteContactForm()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('admin/agent/dashboard');

        $response->assertStatus(200);

        $client = Client::factory()->create()->id;
        $response = $this->get('admin/agent/delete-detail/'. $client);
        $response->assertRedirect('admin/agent/client');
    }

    public function test_AdminCanViewUsers()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);

        $user = new User();
        $user = User::all();

        $response = $this->get('admin/users');
        $response->assertStatus(200);

    }

    public function test_AdminCanEditUser()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);

        $user = new User();

        $response = $this->get('admin/edit-user/1');
        $response->assertStatus(200);
    }

    public function test_AdminCanviewAddUserAndCanAddUser()
    {
        //create user
        $user = User::factory()->create(['role_as' => 1]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);

        $user = new User();
        $user = User::all();

        $response = $this->get('admin/users');
        $response->assertStatus(200);

        $response = $this->get('admin/add-user');
        $response->assertStatus(200);

        $response = $this->post('/admin/add-user-details',[
            'name' =>'bdfgfrjhgf',
            'email' =>'nbmnbv454512@gmail.com',
            'password' =>'12345678',
        ]);
        $response->assertRedirect('/admin/users');

    }

}
