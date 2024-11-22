<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateBillingRequest;
use App\Mail\SendInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    public function generateBill(GenerateBillingRequest $request)
    {
        dd(123);
        Mail::to($request->email)->send(new SendInvoice());

        return view('billing', compact('request'));
    }
}
