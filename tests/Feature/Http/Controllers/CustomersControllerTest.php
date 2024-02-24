<?php

namespace Tests\Feature\Http\Controllers;

use App\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CustomersController
 */
class CustomersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $customers = factory(Customers::class, 3)->create();

        $response = $this->get(route('customer.index'));

        $response->assertOk();
        $response->assertViewIs('customers.index');
        $response->assertViewHas('customers');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $customer = factory(Customers::class)->create();
        $customer = factory(Customer::class)->create();

        $response = $this->get(route('customer.show', $customer));

        $response->assertOk();
        $response->assertViewIs('customers.show');
        $response->assertViewHas('customer');
    }
}
