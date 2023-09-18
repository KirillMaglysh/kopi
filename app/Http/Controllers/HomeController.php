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
        Storage::disk('public')->putFileAs('selfPhoto', $fileSafe, $hashSelf);
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
        if (auth()->user()->id !== _ADMIN_) {
            abort(403);
        }
        $data = Card::all();
        return view('admin.moderation', compact('data'));
    }
}
