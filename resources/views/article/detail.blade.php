@extends('layouts.app')

@section('content')
	<div class="container">
		<articledetail :article="{{$article}}"></articledetail>
	</div>
@endsection
