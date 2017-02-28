<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cate;
use App\Article;
use Illuminate\Support\Facades\Response;
use Auth;
use DB;
class CateController extends Controller
{
    public function store(Request $request)
	{
	    $this->validate($request, [
	        'cate' => 'required|unique:cates|max:50'
	    ]);

	    $article = new Cate;
	    $article->cate = $request->get('cate');
	    $article->user_id = $request->user()->id;

	    if ($article->save()) {
	        return Response::json(['errno'=>0, 'msg'=>'添加成功']);
	    }
	}

	public function index()
	{
	    $cates = Cate::all();

	    return Response::json(['errno'=>0, 'msg'=>'查询成功','cates' => $cates]);
	}

	public function self()
	{
	    $cates = Cate::where('user_id', Auth::user()->id)->get();

	    return Response::json(['errno'=>0, 'msg'=>'查询成功','cates' => $cates]);
	}

	public function show($id)
	{
	    $articles = DB::table('userinfos')
                    ->join('articles', 'userinfos.user_id', '=', 'articles.user_id')
                    ->where('articles.cate_id',$id)
                    ->get();

	    return view('cate/list', compact('articles'));
	}

}
