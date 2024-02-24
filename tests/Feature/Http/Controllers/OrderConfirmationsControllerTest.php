<?php

namespace Tests\Feature\Http\Controllers;

use App\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderConfirmationsController
 */
class OrderConfirmationsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function update_redirects()
    {
        $orderConfirmation = factory(OrderConfirmations::class)->create();
        $orderConfirmation = factory(Order::class)->create();

        $response = $this->put(route('order-confirmation.update', $orderConfirmation));

        $response->assertRedirect(route('orders.index'));
    }
}
