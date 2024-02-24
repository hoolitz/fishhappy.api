<?php

namespace Tests\Feature\Http\Controllers;

use App\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrdersController
 */
class OrdersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $orders = factory(Orders::class, 3)->create();

        $response = $this->get(route('order.index'));

        $response->assertOk();
        $response->assertViewIs('orders.index');
        $response->assertViewHas('orders');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $order = factory(Orders::class)->create();
        $order = factory(Order::class)->create();

        $response = $this->get(route('order.show', $order));

        $response->assertOk();
        $response->assertViewIs('orders.show');
        $response->assertViewHas('order');
    }
}
