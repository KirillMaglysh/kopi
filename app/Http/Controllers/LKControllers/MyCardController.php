<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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

    public function cardItem($id)
    {
        $card = Card::where('id', $id)->first();

        return view('admin.cardItem', compact('card'));
    }

    public function cardDelete($id)
    {
        $cardDeleted = Card::where('id', $id)->delete();
        return redirect()->route('moderation');
    }

    public function myCard(Request $request)
    {
        $info = $request->info;
        $userId = auth()->user()->id;
        $cards = Card::where('user_id', $userId)->where('deleted_at', null)->get();
        $count = count($cards);
        return view('admin.myCard', compact('cards', 'info', 'count'));
    }

    public function cardSuccess($id)
    {
        $card = Card::where('id', $id)->first();
        Card::where('id', $id)->update([
            'dream_name' => $card['dream_name'],
            'description' => $card['description'],
            'photo_card' => $card['photo_card'],
            'summa' => $card['summa'],
            'moderation' => true,
        ]);
        return redirect()->route('cardItem', ['id' => $id]);
    }
}
