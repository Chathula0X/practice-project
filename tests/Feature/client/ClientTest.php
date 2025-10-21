<?php

namespace Tests\Feature\Client;

use App\Models\Client;
use App\Models\Inquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase{

    use RefreshDatabase;

    /**@test */
    public function it_can_create_a_client(){
        $client = Client::factory()->create([
            'name' => 'Test Client',
            'email' => 'test@example.com',
        ]);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals('Test Client', $client->name);
    }

    /**@test */
    public function client_has_fillable_attributes(){

        $client = new Client();
        $fillable = $client->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('email', $fillable);
        $this->assertContains('phone', $fillable);
        $this->assertContains('nationality', $fillable);
        $this->assertContains('preferences', $fillable);
    }

    /**@test */
    public function client_has_relationship_with_inquiry(){

        $client = Client::factory()->create();
        $inquiry = Inquiry::factory()->create(['client_id' => $client->id]);

        $this->assertTrue($client->inquiries->contains($inquiry));
    }

    /**@test */
    public function it_can_have_multiple_inquiries(){

        $client = Client::factory()->create();
        Inquiry::factory()->count(3)->create(['client_id' => $client->id]);

        $this->assertCount(3, $client->inquiries);
    }
}