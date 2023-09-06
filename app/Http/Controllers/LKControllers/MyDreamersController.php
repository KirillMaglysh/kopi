<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MyDreamersController extends Controller
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

    public function myDreamers(Request $request)
    {
        $info = $request->info;
        $userId = auth()->user()->id;
        $dreamersIds = DB::table('users')->where('id', $userId)->first()->dreamersId;
        $cards = [];
        if ($dreamersIds) {
            $cards = DB::table('card')->whereIn('id', $dreamersIds)->get();
        }
        $count = count($cards);

        return view('admin.myDreamers', compact('cards', 'info', 'count'));
    }
}
