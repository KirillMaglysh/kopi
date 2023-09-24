<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class OurDreamersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function dreamersNoFilter()
    {
        $is_filter = false;
        $isAuth = auth()->user() != null;
        $cards = DB::select("
        SELECT card.user_id, card.photo_card, card.dream_name, card.summa, card.collected, users.self_photo, users.name, users.skill_names, users.skill_prices
        FROM card
        JOIN users ON users.id = card.user_id;
        ");

        return view('subs/support', compact('cards', 'is_filter', 'isAuth'));
    }

    public function dreamersFilter(Request $request)
    {
        $data = $request->input();
        $rules = [
            'search_skill' => 'nullable|string|max:50',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('subs/support', compact('errors'));
        }

        $pattern = $data['search_skill'];
        if (empty($pattern)) {
            return $this->dreamersNoFilter();
        }

        $allCards = Card::getModerated();
        $cards = [];
        $is_filter = true;
        foreach ($allCards as $card) {
            if (User::haveSkill($card->user_id, $pattern)) {
                $cards[] = $card;
            }
        }

        $isAuth = auth()->user() != null;
        return view('subs/support', compact('cards', 'is_filter', 'pattern', 'isAuth'));
    }
}
