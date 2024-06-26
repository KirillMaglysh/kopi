<?php

namespace App\Http\Controllers\LKControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NewsController extends Controller
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

    public function newsModeration(Request $request)
    {
        $info = $request->info;
        $newsAll = DB::table('news')->orderByDesc('created_at')->get();
        return view('admin.newsModeration', compact('newsAll', 'info'));
    }

    public function newNews()
    {
        $news = [];
        $edit = false;
        return view('admin.editNews', compact('edit', 'news'));
    }

    public function delete($id)
    {
        DB::table('news')->where('id', $id)->delete();
        return redirect()->route('newsModeration');
    }

    public function edit($id)
    {
        $news = DB::table('news')->where('id', $id)->first();
        $edit = true;
        return view('admin.editNews', compact('edit', 'news'));
    }
}
