<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use Illuminate\Support\Facades\Response;

class MessageController extends Controller
{
    public function new()
    {
        $num = Message::where(['message_id' => Auth::user()->id, 'tag' =>0])->count();

        $data = ['errno'=>0, 'msg'=>'请求成功', 'num' => $num];
		return Response::json($data);
    }
    public function history()
    {
        $messages = Message::where(['message_id' => Auth::user()->id, 'tag' =>1])->get();
        $data = ['errno'=>0, 'msg'=>'请求成功', 'messages' => $messages];
		return Response::json($data);
    }
    public function index()
    {
        $messages = Message::where('message_id', Auth::user()->id)->orderBy('created_at','desc')->get();

        return view('message/index', compact('messages'));
    }
    public function update($id)
    {
        $message = Message::where(['id' => $id, 'message_id' => Auth::user()->id])->first();
        $message->tag = 1;
        $message->save();

        $data = ['errno'=>0, 'msg'=>'修改成功'];
        return Response::json($data);
    }

}
