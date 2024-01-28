<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class PayPalController extends Controller
{
    public function createPaymentLink()
    {
        // PayPal client configuration
        $clientId = Config::get('services.paypal.client_id');
        $clientSecret = Config::get('services.paypal.client_secret');

        // PayPal endpoint to generate a payment link
        $paypalEndpoint = 'https://api.sandbox.paypal.com/v2/checkout/orders';

        // Create a PayPal order
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . base64_encode("$clientId:$clientSecret"),
        ])->post($paypalEndpoint, [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => '10.00', // Replace with the amount you want to charge
                    ],
                ],
            ],
        ]);

        try {
            $response->throw();
            $approvalUrl = $response->json()['links'][1]['href'];
            return response()->json(['approvalUrl' => $approvalUrl]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
