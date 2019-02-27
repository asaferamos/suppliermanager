<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class CompanyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateNewCompany()
    {

        $data = [
            'name'    => "Company One",
            'phone'   => "5555-5555",
            'address' => "Av Paulista",
            'cep'     => "00000-000",
            'cnpj'    => "90.564.267/0001-02"
        ];

        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/companies',$data);
        $response->assertStatus(201);
    }

    public function testCreateNewCompanyWithBadData()
    {

        $data = [
            'name'    => "Company Two",
            'phone'   => "5555-5555",
            'address' => "Av Paulista",
            'cep'     => "00000-000",
            'cnpj'    => "99999999"
        ];

        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user, 'api')->json('POST', '/api/companies',$data);
        $response->assertStatus(400);
    }
}
