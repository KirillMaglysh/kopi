<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use App\Http\Utills\Utilities;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EditNewsController extends Controller
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

    public function editOld(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->input();
        $data['photo'] = $request->file('photo');

        $rules = [
            'name' => 'required|string|max:100',
            'short_desk' => 'required|string|max:1000',
            'long_desk' => 'required|string|max:3000',
            'date' => 'required|date_format:Y-m-d'
        ];
        $validator = Validator::make($data, $rules);

        $news = DB::table('news')->where('id', $data['news_id'])->first();
        if ($validator->fails()) {
            $errors = $validator->errors();
            $edit = true;
            return view('admin.editNews', compact('errors', 'news', 'userId', 'data', 'edit'));
        }

        $data = $this->checkNullable($data, $request, $news);
        $data['date'] = strtotime($data['date']);
        News::updateNewsInfo($data);
        return redirect()->route('newsModeration');
    }

    public function saveNew(Request $request)
    {
        $userId = auth()->user()->id;
        $data = $request->input();
        $data['photo'] = $request->file('photo');

        $rules = [
            'name' => 'required|string|max:100',
            'photo' => 'nullable|file|mimes:jpg,png,jpeg',
            'short_desk' => 'required|string|max:1000',
            'long_desk' => 'required|string|max:3000',
            'date' => 'required|string|max:30',
        ];
        $validator = Validator::make($data, $rules);
        $edit = false;

        if ($validator->fails()) {
            $errors = $validator->errors();
            return view('admin.editNews', compact('errors', 'userId', 'data', 'edit'));
        }

        $data = Utilities::hashPhoto($request, 'photo', 'newsPhoto', $data);
        $data['date'] = strtotime($data['date']) * 1000;
        News::insertNews($data);
        return redirect()->route('newsModeration');
    }

    /**
     * @param mixed $data
     * @param Request $request
     * @param mixed $news
     * @return array|mixed
     */
    private function checkNullable(mixed $data, Request $request, mixed $news): mixed
    {
        if ($data['photo']) {
            $data = Utilities::hashPhoto($request, 'photo', 'newsPhoto', $data);
        } else {
            $data['photo'] = $news->photo;
        }
        return $data;
    }
}
