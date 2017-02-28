@extends('layouts.app')

@section('content')

    <div class="container">
    	<div class="row">
    		<div class="col-md-8">
                <h3 clss="mb-20">专题分类</h3>
    			<articlelist :articles="{{$articles}}"></articlelist>
    		</div>
    		<div class="col-md-4">
    			
    		</div>
    	</div>
    </div>

@endsection
