<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\News;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;


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
        $newsAll = DB::table('news')->orderByDesc('createdAt')->get();
        return view('welcome', compact('partners', 'newsAll'));
    }
}
