<?php

namespace Tests\Unit;
use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Login_view()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_user_login_with_email_and_password()
    {
    //create user
        $user = User::factory()->create();
    //login
        $this->post('login',[
            'email' =>$user->email,
            'password'=>'password'
        ]);
        $this->assertAuthenticated();
    }
}
