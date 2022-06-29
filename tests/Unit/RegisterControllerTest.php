<?php

namespace Tests\Unit;
use App\Models\User;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_view()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_IfAnyOneCanRegisterAnAccount()
    {
        $user = User::factory()->create();
      $response = $this->post('/register',[
          'name'=> $user->name,
          'email' => $user->email,
          'password' =>'password',
    ]);
    $response->assertRedirect('/');
    }
}
