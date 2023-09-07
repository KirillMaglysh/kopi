<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PartnersController extends Controller
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

    public function partnersModeration(Request $request)
    {
        $info = $request->info;
        $partners = Partner::all();
        return view('admin.partnersModeration', compact('partners', 'info'));
    }

    public function newPartner()
    {
        $userId = auth()->user()->id;
        return view('admin.newPartner', compact('userId'));
    }

    public function delete($id)
    {
        DB::table('partners')->where('id', $id)->delete();
        return redirect()->route('partnersModeration');
    }
}
