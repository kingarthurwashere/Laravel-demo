<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function charge(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount * 100, // Amount in cents
            'currency' => 'usd',
        ]);

        return view('payment.confirmation', ['clientSecret' => $paymentIntent->client_secret]);
    }
}
