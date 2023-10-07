<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;


class MyCardController extends Controller
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

    public function card()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();
        if ($user['moderation']) {
            return view('admin.card', compact('userId'));
        } else {
            $error = 'Загрузите справку и дождитесь окончания модерации прежде чем загружать карточку';
            return redirect()->route('self', compact('error'));
        }
    }

    public function cardDelete($id)
    {
        $cardDeleted = Card::where('id', $id)->delete();
        return redirect()->route('moderation');
    }

    public function myCard()
    {
        $userId = auth()->user()->id;
        $cards = DB::select("
        SELECT card.id, card.user_id, card.photo_card, card.dream_name, card.summa, card.collected, card.moderation, users.self_photo, users.name, users.skill_names, users.skill_prices
        FROM card
        JOIN users ON users.id = card.user_id
        WHERE user_id = ($userId)");
        $count = count($cards);
        $agent = new Agent();
        return view('admin.myCard', compact('cards', 'count', 'agent'));
    }

    public function myCardMore($id)
    {
        $card = Card::where('id', $id)->first();
        $user = DB::table('users')->find($card->user_id, ['name', 'tg_link', 'vk_link', 'self_photo', 'skill_names', 'skill_prices', 'skill_hour']);
        $isAuth = auth()->user() != null;
        if (!$isAuth || (auth()->user()->id != _ADMIN_ && auth()->user()->id != $card->user_id)) {
            abort(403);
        }

        return view('subs/cardMore', compact('card', 'user', 'isAuth'));
    }

    public function cardSuccess($id)
    {
        Card::where('id', $id)->update(['moderation' => true,]);
        return redirect()->route('moderation');
    }

    public function changeSum(Request $request)
    {
        $data = $request->input();
        $card = Card::where('id', $data['cardId'])->first();
        if ($card->user_id != auth()->user()->id) {
            abort(403);
        }

        Card::where('id', $data['cardId'])->update(['collected' => ($card->collected + $data['dif'])]);
        return redirect()->route('myCard');
    }
}
