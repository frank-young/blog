@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑文章</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>发布失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif
                    <upload :token="'{{ csrf_token() }}'" :path="'{{$article->image_path}}'" ref="upload"></upload>
                    <form action="{{ url('article/update') }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="image_path" v-model="imagePath">
                        <input type="hidden" name="id" value="{{$article->id}}" >
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章标题</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{$article->title}}" class="form-control" required="required" placeholder="文章标题">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章专题分类</label>
                            <div class="col-sm-3">
                                <input type="hidden" name="cate_id" required="required" v-model="defaultId">
                                <span style="margin-top: 7px;margin-left: 13px;display: inline-block;color: #666;" v-text="defaultCate"></span>
                            </div>
                             <div class="col-sm-7 text-right">
                                <a class="btn btn-info" data-toggle="modal" data-target="#selectCate" @click="getCate">选择分类</a>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#addCate"> 新添分类</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章描述</label>
                            <div class="col-sm-10">
                                <textarea name="description" rows="3" class="form-control" placeholder="文章描述">{{$article->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章内容</label>
                            <div class="col-sm-10">
                                <textarea name="body" rows="10" class="form-control" required="required" placeholder="文章内容">{{$article->body}} {{$article->image_path}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">文章签名</label>
                            <div class="col-sm-10">
                                <input type="text" name="self_sign" value="{{$article->self_sign}}" class="form-control" placeholder="文章签名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <button class="btn btn-primary" @click="getImagePath">保存</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  
<div class="modal fade " id="addCate" tabindex="-1" role="dialog" aria-labelledby="addCateLabel">
  <div class="modal-dialog " role="document">
    <form @submit.prevent="addCate"  method="POST" class="form-horizontal comment-input">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="addCateLabel">添加专题分类</h4>
      </div>
      <div class="modal-body">
        
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3" style="margin-top:40px; margin-bottom:40px;">
                    <input type="text" v-model="cateName" name="cate" class="form-control" required="required" placeholder="请输入专题分类名称">
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
        <button type="submit"  class="btn btn-primary" >添加</button>
      </div>
    </div>
    </form>
  </div>
</div>

<div class="modal fade " id="selectCate" tabindex="-1" role="dialog" aria-labelledby="selectCateLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="selectCateLabel">选择分类</h4>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-3 text-center " v-for="cate in cates">
                    <div class="cate-wrap" v-text="cate.cate" @click="selectCate(cate.id, cate.cate)">
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
        <button class="btn btn-primary" data-dismiss="modal">确定</button>
      </div>
    </div>
  </div>
</div>

@endsection
