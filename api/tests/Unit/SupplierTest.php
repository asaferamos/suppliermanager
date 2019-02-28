<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierTest extends TestCase
{
    public function testCreateNewSupplier()
    {
        $company = \App\Company::find(1);

        $data = [
            'name'           => "Supplier One",
            'email'          => "supplier@supplier.com",
            'monthlypayment' => 300.00,
            'company_id'     => $company->id
        ];

        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/suppliers',$data);
        $response->assertStatus(201);
    }

    public function testCreateNewSupplierWithBadEamil()
    {
        $company = \App\Company::find(1);

        $data = [
            'name'           => "Supplier One",
            'email'          => "supplier@supplie",
            'monthlypayment' => 300.00,
            'company_id'     => $company->id
        ];

        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/suppliers',$data);
        $response->assertStatus(422);
    }
}
