@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <carousel></carousel>
                <cate></cate>
                <articlelist :articles="{{$articles}}"></articlelist>
            </div>
            <div class="col-md-4">
                
            </div>
        </div>
    </div>

@endsection
