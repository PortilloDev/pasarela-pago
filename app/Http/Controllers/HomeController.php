<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function pay(Request $request){

        //dd($request->all());
        Stripe::setApiKey(env('STRIPE_SECRET'));
       try {
        $customer = Customer::create([
            'email' => $request->input('stripeEmail'),
            'source'  => $request->input('stripeToken'),
          ]);

          $charge = Charge::create([
            'customer' => $customer,
            'amount'   => 1000,
            'currency' => 'eur',
            "description" => "subscripción anual",
          ]);

        } catch(\Exception $e) {
            return view('home')->with('error', $e->getMessage());
        }

              return view('home');
    }

    public function subscribe(Request $request){

        $user = Auth::loginUsingId(1);
        $plan = "monthly";

        $stripe_token = $request->input('stripeToken');

        $user->newSubscription('main', $plan)->create($stripe_token);
    }
}
