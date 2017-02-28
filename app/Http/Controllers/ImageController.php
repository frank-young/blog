<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use App\Image;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{	
    public function upload(Request $request){
        $message="0";
        $validator=Validator::make($request->all(),[
            'file'=>'required|image'
        ] );
        if($validator->fails()){
            return Response::json([
                'errno'=>4000,
                'message'=>$validator->errors()
            ]);
        } else {
            $file=$request->file('file');//获取文件
            $fileName=md5(time().rand(0,10000)).'.'.$file->getClientOriginalName();//随机名称+获取图片的原始名称
            $savePath = 'uploads/article/'.$fileName;//存储到指定文件，例如image/.filename public/.filename
            Storage::put($savePath,File::get($file));//通过Storage put方法存储   File::get获取到的是文件内容
            if(Storage::exists($savePath)){
                $user=Auth::user();
                Image::create([
                    'user_id'=>$user->id,
                    'path'=>$savePath
                ]);
                $image = new Image;
                $image->user_id = $user->id;
                $image->path = $savePath;
				if ($image->save()) {
			        $data = ['errno'=>0, 'msg'=>'上传成功！', 'path' => $savePath, 'image_id' => $image->id];
					return Response::json($data);
			    }
            }
        }
    }
}