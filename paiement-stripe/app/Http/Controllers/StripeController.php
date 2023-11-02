<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = $request->get('productname');
        $totalprice = $request->get('total');
        $two0 = "00";
        $total = "$totalprice$two0";

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'EUR',
                        'product_data' => [
                            "name" => $productname,
                        ],
                        'unit_amount'  => $total,
                    ],
                    'quantity'   => 1,
                ],

            ],
            'mode'        => 'payment',
            'success_url' => route('success'). "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url'  => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $sessionId = $request->get('session_id');

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        if (!$session) {
            throw new NotFoundHttpException;
        }
dd($session);
        // $customer = \Stripe\Customer::retrieve($session->customer);


        // $stripe = new \Stripe\StripeClient('sk_test_51O6t2tE4utFKK4ZV8S7mKra1p7s4sHe4D02rCoIuLZNbBv1LE5ofGOoqkD887cwckghXuv1eVar9IIaHYV13IcVj00T8o5Ht1E');
        
        // $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
        // $customer = $stripe->customers->retrieve($session->customer);

           

            return view('sucess', compact('customer'));
       
            
            
        // return view('sucess', compact('customer'));
    }
}
