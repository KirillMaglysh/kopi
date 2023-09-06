<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Http\Utills\Utilities;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class NewCardController extends Controller
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
        $user = DB::table('users')->where('id', $userId);
        $data['photo'] = $request->file('photo');

        $rules = [
            'dream_name' => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'photo' => 'required|file|mimes:jpg',
            'userId' => 'required|integer|',
            'summa' => 'required|integer|',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('admin.card', compact('errors', 'userId'));
        }
        Utilities::hashPhoto($request, 'photo', 'cardPhotos', $data);
        Card::saveUserCard($data);
        if (auth()->user()->id === 1) {
            $info = 'Твоя карточка принята на модерацию! Когда она ее пройдет, то станет зеленой!';
            return redirect()->route('myCard', compact('info'));
        } else {
            $info = 'Твоя карточка принята на модерацию!  Когда она ее пройдет, то станет зеленой!';
            return redirect()->route('myCard', compact('info'));
        }
    }
}
