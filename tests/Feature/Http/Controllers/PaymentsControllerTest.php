<?php

namespace Tests\Feature\Http\Controllers;

use App\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaymentsController
 */
class PaymentsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $payments = factory(Payments::class, 3)->create();

        $response = $this->get(route('payment.index'));

        $response->assertOk();
        $response->assertViewIs('payments.index');
        $response->assertViewHas('payments');
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $payment = factory(Payments::class)->create();
        $payment = factory(Payment::class)->create();

        $response = $this->get(route('payment.show', $payment));

        $response->assertOk();
        $response->assertViewIs('payments.show');
        $response->assertViewHas('payment');
    }
}
