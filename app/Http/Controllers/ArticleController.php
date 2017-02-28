<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;  
use App\Http\Controllers\Controller;
use App\Article;
use App\Userinfo;
use DB;
use Auth;
use Illuminate\Support\Facades\Response;

class ArticleController extends Controller
{

    public function show($id) {
    	$article = DB::table('userinfos')
		            ->join('articles', 'userinfos.user_id', '=', 'articles.user_id')
		            ->where('articles.id',$id)
		            ->get();

		// return $article;
    	return view('article/detail', compact('article'));
    }

    public function create()
	{
	    return view('article/create');
	}

	public function edit($id)
	{
	    $article = Article::where('id', $id)->first();
	    // return $article;
        return view('article/edit', compact('article'));
	}

	public function store(Request $request)
	{
	    $this->validate($request, [
	        'title' => 'required|max:255',
	        'description' => 'required',
	        'cate_id' => 'required',
	        'body' => 'required',
	    ]);

	    $article = new Article;
	    $article->title = $request->get('title');
	    $article->cate_id = $request->get('cate_id');
	    $article->image_path = $request->get('image_path');
	    $article->description = $request->get('description');
	    $article->body = $request->get('body');
	    $article->self_sign = $request->get('self_sign');
	    $article->user_id = $request->user()->id;

	    if ($article->save()) {
	        return redirect('/article/'.$article->id);
	    } else {
	        return redirect()->back()->withInput()->withErrors('保存失败！');
	    }
	}

	public function update(Request $request)
    {
    	$this->validate($request, [
	        'title' => 'required|max:255',
	        'description' => 'required',
	        'cate_id' => 'required',
	        'body' => 'required'
	    ]);
    	$article = Article::where('id', $request->get('id'))->first();
        $article->title = $request->get('title');
	    $article->cate_id = $request->get('cate_id');
	    $article->image_path = $request->get('image_path');
	    $article->description = $request->get('description');
	    $article->body = $request->get('body');
	    $article->self_sign = $request->get('self_sign');
	    $article->user_id = $request->user()->id;

		if($article->save()) {
			return redirect('/article/'.$request->get('id'));
		} else {
	        return redirect()->back()->withInput()->withErrors('保存失败！');
	    }
        
    }

	public function destroy($id)  
	{
	    Article::find($id)->delete();
	    return Response::json(['errno'=>0, 'msg'=>'删除成功']);
	}
}
