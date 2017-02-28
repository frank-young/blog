@extends('layouts.app')

@section('content')
	<div class="container">
		<articledetail :article="{{$article}}"></articledetail>
    	<comment :token="'{{ csrf_token() }}'" :article="{{$article}}" ></comment>
	</div>
@endsection
