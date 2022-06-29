<?php

namespace Tests\Unit;
use App\Models\Client;
use App\Models\Permission;
use App\Models\User;
use Tests\TestCase;


class AgentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_AgentShouldBeRedirectedToLoginPageIfAgentVisitsAgentDashboardWithoutLoggingIn()
    {
        $response = $this->get('/agent/dashboard');

        $response->assertStatus(302);
    }

     public function test_AgentloginAndViewDashboard()
     {
         //create user
         $user = User::factory()->create(['role_as' => 2]);
         //login
         $this->post('login', [
             'email' => $user->email,
             'password' => 'password'
         ]);
         $this->assertAuthenticated();
         $response = $this->get('/agent/dashboard');

         $response->assertStatus(200);
     }

    public function test_agentCanViewContactFormIfAgentHasPermissionsToViewIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);
        $permission = new Permission();
        $permission->permission_id = 1;
        $permission->user_id =  $user->id;
        $permission->save();

        $client = Client::factory()->create();
        $response = $this->get('/agent/client');


        $response->assertStatus(200);


    }

    public function test_agentCanNotViewContactFormIfAgentHasNotPermissionsToViewIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);


        $response = $this->get('/agent/client');


        $response->assertStatus(302);
    }

    public function test_agentCanEditContactFormIfAgentHasPermissionsToEditIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);
        $permission = new Permission();
        $permission->permission_id = 2;
        $permission->user_id =  $user->id;
        $permission->save();

        $client = Client::factory()->create()->id;
        $response = $this->get('/agent/edit-detail/'. $client);


        $response->assertStatus(200);
    }

    public function test_agentCanDeleteContactFormIfAgentHasPermissionsToDeleteIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);

        $permission = new Permission();
        $permission->permission_id = 3;
        $permission->user_id =  $user->id;
        $permission->save();

        $client = Client::factory()->create()->id;
        $response = $this->get('agent/delete-detail/' . $client);
        $response->assertRedirect('agent/client');

    }

    public function test_agentCanViewUserIfAgentHasPermissionsToViewIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);
        $permission = new Permission();
        $permission->permission_id = 4;
        $permission->user_id =  $user->id;
        $permission->save();


        $response = $this->get('agent/users');


        $response->assertStatus(200);
    }
    public function test_agentCanEditUserIfAgentHasPermissionsToEditIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);
        $permission = new Permission();
        $permission->permission_id = 5;
        $permission->user_id =  $user->id;
        $permission->save();


        $response = $this->get('agent/edit-user/1');


        $response->assertStatus(200);
    }

    public function test_agentCanAddUserIfAgentHasPermissionsToAddIt()
    {
        //create user
        $user = User::factory()->create(['role_as' => 2]);
        //login
        $this->post('login', [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticated();
        $response = $this->get('/agent/dashboard');
        $response->assertStatus(200);
        $permission = new Permission();
        $permission->permission_id = 6;
        $permission->user_id =  $user->id;
        $permission->save();


        $response = $this->get('agent/add-user');


        $response->assertStatus(200);
    }
}
