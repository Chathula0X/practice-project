<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Client;

class ClientTest extends TestCase{

    public function test_if_client_can_be_created(){

        $client = new Client([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'nationality' => 'Sri Lankan',
            'preferences' => 'I want to travel to Ella',
        ]);

        $this->assertEquals('John Doe', $client->name);
        $this->assertEquals('john@example.com', $client->email);
        $this->assertEquals('1234567890', $client->phone);
        $this->assertEquals('Sri Lankan', $client->nationality);
        $this->assertEquals('I want to travel to Ella', $client->preferences);
    }

    public function test_it_can_return_full_content_of_client(){

        $client = new Client([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'nationality' => 'Sri Lankan',
            'preferences' => 'I want to travel to Ella',
        ]);

        $contact = "{$client->name} ({$client->email}) - {$client->phone} - {$client->nationality} - {$client->preferences}";

        $this->assertStringContainsString('John Doe', $contact);
        $this->assertStringContainsString('john@example.com', $contact);
        $this->assertStringContainsString('1234567890', $contact);
        $this->assertStringContainsString('Sri Lankan', $contact);
        $this->assertStringContainsString('I want to travel to Ella', $contact);
    }
}
