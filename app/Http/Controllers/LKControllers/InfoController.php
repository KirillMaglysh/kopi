<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Http\Utills\Utilities;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class InfoController extends Controller
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
        $user = DB::table('users')->find($userId, ['tg_link', 'vk_link', 'self_photo', 'qr_photo']);
        $data['self_photo'] = $request->file('self_photo');
        $data['qr_photo'] = $request->file('qr_photo');

        $rules = [
            'self_photo' => 'nullable|file|mimes:jpg,png,jpeg',
            'tg_link' => 'required|url|max:100',
            'vk_link' => 'nullable|url|max:100',
            'qr_photo' => 'nullable|file|mimes:jpg,png,jpeg',
            'userId' => 'required|integer|',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('admin.info', compact('errors', 'userId', 'user'));
        }

        $data = $this->checkNullable($data, $request, $user);
        $data = $this->readSkills($data);

        User::updateUserInfo($data);
        $info = 'Сохранено';
        return redirect()->route('info',
            compact('info', 'data'));
    }

    public function info()
    {
        $userId = auth()->user()->id;
        $user = DB::table('users')->find($userId, ['tg_link', 'vk_link', 'self_photo', 'qr_photo', 'skill_names', 'skill_prices']);
        return view('admin.info', compact('userId', 'user'));
    }

    /**
     * @param mixed $data
     * @param Request $request
     * @param mixed $user
     * @return array|mixed
     */
    private function checkNullable(mixed $data, Request $request, mixed $user): mixed
    {
        if ($data['self_photo']) {
            $data = Utilities::hashPhoto($request, 'self_photo', 'selfPhoto', $data);
        } else {
            $data['self_photo'] = $user->self_photo;
        }

        if ($data['qr_photo']) {
            $data = Utilities::hashPhoto($request, 'qr_photo', 'cardQrs', $data);
        } else {
            $data['qr_photo'] = $user->qr_photo;
        }

        if (!$data['vk_link']) {
            $data['vk_link'] = $user->vk_link;
        }
        return $data;
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function readSkills(mixed $data): mixed
    {
        $data['skill_names'] = array();
        $data['skill_prices'] = array();
        for ($i = 0; $i < 32; $i++) {
            if (array_key_exists('skill_' . $i . '_name', $data)) {
                $skill_name = $data['skill_' . $i . '_name'];
                $skill_price = $data['skill_' . $i . '_price'];
                if ($skill_name && is_numeric($skill_price)) {
                    $data['skill_names'][] = $skill_name;
                    $data['skill_prices'][] = $skill_price;
                }
            }
        }
        return $data;
    }
}
