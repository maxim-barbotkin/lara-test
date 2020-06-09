<?php

namespace Tests\Feature;

use App\Clients;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_create_client() {
        $client = [
            'l_name' => "Dev name",
            'email' => "dev@gmail.com",
            'password' => 'asd32d3d232'
        ];

        $this->post(route('client.create'), $client)
            ->assertStatus(200)
            ->assertJson($client);
    }

    public function test_can_show_client() {

        $client = factory(Clients::class)->create();

        $this->get(route('client.show', $client->id))
            ->assertStatus(200);
    }

    public function test_can_delete_client() {

        $client = factory(Clients::class)->create();

        $this->delete(route('client.destroy', $client->id))
            ->assertStatus(200);
    }

    public function test_can_list_clients() {
        $clients = factory(Clients::class, 10)->create()->map(function ($clients) {
            return $clients->only(['id', 'l_name', 'email','password']);
        });

        $this->get(route('clients.list'))
            ->assertStatus(200);
    }
}
