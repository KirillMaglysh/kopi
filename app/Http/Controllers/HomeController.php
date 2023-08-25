<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function self(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();
        $moderation = 0;
        if ($user['fileSelf'] && $user['moderation']) {
            $moderation = 1;
        } elseif (!$user['fileSelf'] && !$user['moderation']) {
            $moderation = 3;
        }
        $data = [];
        if ($user['fileSelf']) {
            $data['fileSelf'] = $user['fileSelf'];
         }
        $error = $request->error;
        return view('admin.self', compact('error', 'moderation', 'data'));
    }

    public function selfSave(Request $request)
    {
        $userId = auth()->user()->id;
        $fileSafe = $request->file("fileSafe");
        $hashSelf = Hash::make($fileSafe);
        $hashSelf = str_replace('/', 'a', $hashSelf);
        Storage::disk('public')->putFileAs('selfPhoto', $fileSafe, $hashSelf . '.jpg');
        DB::table('users')
            ->where('id', $userId)
            ->update(['fileSelf' => $hashSelf]);

        return redirect()->route('self');
    }

    public function selfModeration()
    {
        $users = User::all();
        return view('admin.selfModeration', compact('users'));
    }

    public function selfSuccess(int $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update(['moderation' => 1]);

        return redirect()->route('selfModeration');
    }

    public function moderation()
    {
        if (auth()->user()->id !== 1) {
            abort(403);
        }
        $data = Card::all();
        return view('admin.moderation', compact('data'));
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
                'skills' => $card['skills'],
                'gratitude' => $card['gratitude'],
                'for_what' => $card['for_what'],
                'aim' => $card['aim'],
                'description' => $card['description'],
                'photo_card' => $card['photo_card'],
                'link_tg' => $card['link_tg'],
                'link_vk' => $card['link_vk'],
                'photo_qr' => $card['photo_qr'],
                'summa' => $card['summa'],
                'phone_number' => $card['phone_number'],
                'moderation' => true,
            ]);
        return redirect()->route('cardItem', ['id' => $id]);
    }

    public function save(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->input();
        $data['photo'] = $request->file('photo');
        $data['qr'] = $request->file('qr');

        $rules = [
            'skills' => 'required|string|max:30',
            'gratitude' => 'required|string|max:100',
            'for_what' => 'required|string|max:50',
            'aim' => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'photo' => 'required|file|mimes:jpg',
            'link_tg' => 'required|string|',
            'link_vk' => 'required|string|',
            'qr' => 'required|file|mimes:jpg',
            'userId' => 'required|integer|',
            'summa' => 'required|integer|',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('admin.card', compact('errors', 'userId'));
        }
        $photoCardFile = $request->file('photo');
        $hashPhotoCard = Hash::make($photoCardFile);
        $hashPhotoCard = str_replace('/', 'a', $hashPhotoCard);
        $data['photo'] = $photoCardFile;
        Storage::disk('public')->putFileAs('cardPhotos', $photoCardFile, $hashPhotoCard . '.jpg');

        $photoQrFile = $request->file('qr');
        $hashQrCard = Hash::make($photoQrFile);
        $hashQrCard = str_replace('/', 'a', $hashQrCard);
        $data['qr'] = $photoQrFile;
        Storage::disk('public')->putFileAs('cardQrs', $photoQrFile, $hashQrCard . '.jpg');
        $data['photo'] = $hashPhotoCard;
        $data['qr'] = $hashQrCard;

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
