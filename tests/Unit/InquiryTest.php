<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Inquiry;
use App\Models\Client;

class InquiryTest extends TestCase{

    public function test_if_inquiry_can_be_created(){
        
      $inquiry = new Inquiry([

        'client_id' => 1,
        'destination' => 'Ella',
        'start_date' => '2025-01-01',
        'end_date' => '2025-01-02',
        'budget' => 10000,
        'note' => 'I want to travel to Ella',
      ]);

      $this->assertEquals(1, $inquiry->client_id);
      $this->assertEquals('Ella', $inquiry->destination);
      $this->assertEquals('2025-01-01', $inquiry->start_date);
      $this->assertEquals('2025-01-02', $inquiry->end_date);
      $this->assertEquals(10000, $inquiry->budget);
      $this->assertEquals('I want to travel to Ella', $inquiry->note);
    }

    public function test_it_can_return_full_content_of_inquiry(){

        $inquiry = new Inquiry([
            'client_id' => 1,
            'destination' => 'Ella',
            'start_date' => '2025-01-01',
            'end_date' => '2025-01-02',
            'budget' => 10000,
            'note' => 'I want to travel to Ella',
        ]);
    

    $contact = "{$inquiry->client_id} - {$inquiry->destination} - {$inquiry->start_date} - {$inquiry->end_date} - {$inquiry->budget} - {$inquiry->note}";

    $this->assertStringContainsString(1, $contact);
    $this->assertStringContainsString('I want to travel to Ella', $contact);
    $this->assertStringContainsString('2025-01-01', $contact);
    $this->assertStringContainsString('2025-01-02', $contact);
    $this->assertStringContainsString(10000, $contact);
    $this->assertStringContainsString('I want to travel to Ella', $contact);

    }

    public function test_it_can_return_the_client_of_the_inquiry(){

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
}
