<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Http\Utills\Utilities;
use App\Models\Card;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NewPartnerController extends Controller
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

    public function save(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->input();
        $data['photo'] = $request->file('photo');

        $rules = [
            'name' => 'required|string|max:100',
            'photo' => 'required|file|mimes:jpg,png,jpeg',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('admin.newPartner', compact('errors', 'userId'));
        }
        $data = Utilities::hashPhoto($request, 'photo', 'partnerPhoto', $data);
        Partner::insert($data);
        return redirect()->route('partnersModeration');
    }
}
