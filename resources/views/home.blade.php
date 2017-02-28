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
                <div class="side">
                    <a href="" class="btn btn-block btn-img">
                        <img src="img/banner1.png" alt="">
                    </a>
                     <a href="" class="btn btn-block btn-img">
                        <img src="img/banner2.png" alt="">
                    </a>
                     <a href="" class="btn btn-block btn-img">
                        <img src="img/banner3.png" alt="">
                    </a>
                     <a href="" class="btn btn-block btn-img">
                        <img src="img/banner4.png" alt="">
                    </a>
                </div>
                <auth></auth>
            </div>
        </div>
    </div>

@endsection
