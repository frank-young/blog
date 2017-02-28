@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">个人设置</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>操作失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                	<avatar :token="'{{ csrf_token() }}'" :path="'{{$userinfo->avatar_path}}'" ref="avatar"></avatar>
                    <form action="{{ url('userinfo/update') }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        <input type="hidden" name="avatar_path" v-model="avatarPath">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">昵称</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{$userinfo->name}} " name="name" class="form-control" required="required" placeholder="昵称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">个人简介</label>
                            <div class="col-sm-10">
                                <textarea name="info" rows="3" class="form-control" placeholder="个人简介">{{$userinfo->info}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
								<button class="btn btn-primary" @click="getavatarPath">保存</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  

@endsection
