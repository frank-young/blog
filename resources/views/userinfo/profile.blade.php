@extends('layouts.app')
@section('content')
<div class="container">  
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">个人中心</div>
                <div class="panel-body">
                    <articlelist :token="'{{ csrf_token() }}'" :articles="{{$articles}}"></articlelist>
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
        </div>
    </div>
</div>  

@endsection
