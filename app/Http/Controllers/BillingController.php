<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateBillingRequest;
use App\Mail\SendInvoice;
use App\Models\Order;
use App\Services\BillingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class BillingController extends Controller
{
    /**
     * Generates a bill for a customer based on products and quantities specified in the request.
     *
     * @param \App\Http\Requests\GenerateBillingRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateBill(GenerateBillingRequest $request): RedirectResponse
    {
        $order = (new BillingService())->invoice($request);
        Mail::to($request->email)->send(new SendInvoice());

        return to_route('billing.success', $order);
    }

    /**
     * Show the success page for a given order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function success(Order $order): View
    {
        return view('success', compact('order'));
    }
}
