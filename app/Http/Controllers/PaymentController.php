<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function cancelled()
    {
        return redirect()
            ->route('home')
            ->withErrors('you cancelled the payment');
    }
}
