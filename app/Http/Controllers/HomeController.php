<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = DB::table('userinfos')
                    ->join('articles', 'userinfos.user_id', '=', 'articles.user_id')
                    ->get();

        return view('home', compact('articles'));
    }
}
