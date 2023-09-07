<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Partner;


class PublicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show()
    {
        $partners = Partner::all();
        return view('welcome', compact('partners'));
    }
}
