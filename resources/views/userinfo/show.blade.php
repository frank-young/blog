@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">个人中心</div>
                <div class="panel-body">
                    <userarticle :token="'{{ csrf_token() }}'" :articles="{{$articles}}"></userarticle>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
            	<div class="col-md-12">
            		<div class="panel panel-default">
		                <div class="panel-heading">个人简介</div>
		                <div class="panel-body">

		                </div>
		            </div>
            	</div>
            </div>
            <div class="row">
        		<div class="col-md-12">
        			<a href="/blog/public/article/create" class="btn btn-info btn-block">写文章</a>
        		</div>
        	</div>
        	<hr>
        	<div class="row">
            	<div class="col-md-12">
            		<div class="panel panel-default">
		                <div class="panel-heading">我的专题</div>
		                <div class="panel-body">
							<usercate></usercate>
		                </div>
		            </div>
            	</div>
            </div>
                    
        </div>
    </div>
</div>  

@endsection
