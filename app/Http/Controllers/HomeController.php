<?php

namespace App\Http\Controllers;

use App\Http\Utills\Utilities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;


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
        $data = $request->input();
        $data = Utilities::hashPhoto($request, 'fileSafe', 'docPhoto', $data);

        DB::table('users')
            ->where('id', $userId)
            ->update(['fileSelf' => $data['fileSafe']]);

        return redirect()->route('self');
    }

    public function selfModeration()
    {
        $users = DB::table("users")->orderByDesc('created_at')->get();
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
        if (auth()->user()->id !== _ADMIN_) {
            abort(403);
        }

        $cards = DB::select("
        SELECT card.id, card.user_id, card.photo_card, card.dream_name, card.summa, card.collected, card.moderation, users.self_photo, users.name, users.skill_names, users.skill_prices
        FROM card
        JOIN users ON users.id = card.user_id");
        $agent = new Agent();
        return view('admin.moderation', compact('cards', 'agent'));
    }
}
