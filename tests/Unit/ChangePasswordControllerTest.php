<?php

namespace Tests\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_ChangePasswordCannotBeViewIfNotLogin()
    {
        $response = $this->get('change-password');

        $response->assertStatus(302);
    }

    public function test_ChangePasswordAfterLogin()
    {
        //create user
        $user = User::factory()->create(['password'=> Hash::make('password')]);
        //login
        $this->post('login',[
            'email' =>$user->email,
            'password'=>'password'
        ]);
        $this->actingAs($user);
        $response = $this->post('update-password',[
            'old_password'=>'password',
            'new_password'=> '123456789',
            'confirm_password'=>'123456789',
            ]);
        $response->assertStatus(200);
    }
}
