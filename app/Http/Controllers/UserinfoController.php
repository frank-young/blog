<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Article;
use App\Cate;
use App\User;
use App\Userinfo;
use DB;

class UserinfoController extends Controller
{
    public function show()
    {
        $articles = Article::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('userinfo/show', compact('articles'));
    }

    public function profile($id)
    {
        $articles = DB::table('userinfos')
                    ->join('articles', 'userinfos.user_id', '=', 'articles.user_id')
                    ->where('userinfos.user_id',$id)
                    ->get();
                    // return $articles;
        return view('userinfo/profile', compact('articles'));
    }

    public function edit()
    {
    	$userinfo = Userinfo::where('user_id', Auth::user()->id)->first();
        return view('userinfo/edit', compact('userinfo'));
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
	        'avatar_path' => 'required',
	    ]);

        $userinfo = Userinfo::where('user_id', $request->user()->id)->first();
        $userinfo->avatar_path = $request->get('avatar_path');
        $userinfo->info = $request->get('info');

		if($userinfo->save()) {
			return redirect('/userinfo/show');
		} else {
	        return redirect()->back()->withInput()->withErrors('保存失败！');
	    }
        
    }
}
