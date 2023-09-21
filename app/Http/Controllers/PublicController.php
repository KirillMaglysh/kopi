<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;


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
        $isAuth = auth()->user() != null;
        $agent = new Agent();
        $partners = Partner::all();
        $newsAll = DB::table('news')->orderByDesc('created_at')->limit(20)->get();
        return view('welcome', compact('partners', 'newsAll', 'agent', 'isAuth'));
    }
}
