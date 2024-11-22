<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the index view.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('index');
    }
}
