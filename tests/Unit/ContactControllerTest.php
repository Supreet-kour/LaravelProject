<?php

namespace Tests\Unit;
use App\Models\Client;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Contact_view()
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
    }

    public function test_contact_details()
    {
        $client = Client::factory()->create();
      //  $response = $this->post('/contact-us',[
          $response =  $this->post('/contact-us', [
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'msg' => $client->msg,
                'user_id' => $client->user_id,
            ]);
        $response->assertRedirect('/');
    }

}
