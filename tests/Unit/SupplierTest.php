<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Supplier;

class SupplierTest extends TestCase{

    public function test_if_supplier_can_be_created(){

        $supplier = new Supplier([
            'name' => 'John Doe',
            'type' => 'Hotel',
            'email' => 'john@example.com',
            'location' => 'Colombo',
            'notes' => 'I want to travel to Ella',
        ]);

        $this->assertEquals('John Doe', $supplier->name);
        $this->assertEquals('Hotel', $supplier->type);
        $this->assertEquals('john@example.com', $supplier->email);
        $this->assertEquals('Colombo', $supplier->location);
        $this->assertEquals('I want to travel to Ella', $supplier->notes);
    }

    public function test_it_can_return_full_content_of_supplier(){

        $supplier = new Supplier([
            'name' => 'John Doe',
            'type' => 'Hotel',
            'email' => 'john@example.com',
            'location' => 'Colombo',
        ]);

        $contact = "{$supplier->name} ({$supplier->email}) - {$supplier->location}";

        $this->assertStringContainsString('John Doe', $contact);
        $this->assertStringContainsString('john@example.com', $contact);
        $this->assertStringContainsString('Colombo', $contact);
    }

}   
