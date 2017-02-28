<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userinfo;
use App\Comment;
use App\Message;
use Auth;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    public function store(Request $request)  
	{	
		$this->validate($request, [
	        'content' => 'required'
	    ]);

	    $comment = new Comment;
	    $comment->avatar_path = $request->get('avatar_path');
	    $comment->article_id = $request->get('article_id');
	    $comment->user_id = $request->get('user_id');
	    $comment->name = $request->get('name');
	    $comment->content = $request->get('content');

	    if ($comment->save()) {
	    	$message = new Message;
	    	$message->avatar_path = $request->get('avatar_path');
		    $message->article_id = $request->get('article_id');
		    $message->user_id = $request->get('user_id');
		    $message->name = $request->get('name');
		    $message->content = $request->get('content');
		    $message->message_id = $request->get('message_id');
		    $message->tag = 0;
		    $message->save();
	        return Response::json(['errno'=>0, 'msg'=>'评论成功！']);
	    } else {
	        return Response::json(['errno'=>4000, 'msg'=>'评论失败！']);
	    }
	}
	public function info()
    {
    	if(Auth::check()) {
    		$userinfo = Userinfo::where('user_id', Auth::user()->id)->first();
			$data = ['errno'=>0, 'msg'=>'请求成功', 'userinfo' => $userinfo];
			return Response::json($data);
    	} else {
    		$data = ['errno'=>3000, 'msg'=>'未登录'];
			return Response::json($data);
    	}

    }

    public function list($id)
    {
        $comments = Comment::where('article_id', $id)->orderBy('created_at','desc')->get();
        $count = Comment::where('article_id', $id)->count();

        $data = ['errno'=>0, 'msg'=>'请求成功', 'comments' => $comments, 'count' => $count];
		return Response::json($data);
    }
    public function destroy($id)  
	{
	    Comment::find($id)->delete();
	    $data = ['errno'=>0, 'msg'=>'删除成功'];
		return Response::json($data);
	}
}
