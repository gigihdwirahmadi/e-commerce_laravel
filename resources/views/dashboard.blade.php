@extends('layouts.template2')
@section('title')
    Home
@endsection
@section('style')
    <style>
        .grid-1 {
            display: grid;
            grid-template-columns: 500px 1fr;
            padding: 0 0px;
            background-color: #f9dc5c;
        }
        nav{
            background-color: #f9dc5c;
        }
        .div-menu{
            border-radius: 23px;
background: linear-gradient(145deg, #d8d8d8, #ffffff);
box-shadow:  30px 30px 60px #cecece,
             -30px -30px 60px #ffffff;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid grid-1" style="height: 550px; width:100%">
        <div class="" style="height: 100%; width:100%">
            <img src=" {{ asset('storage/asset/7a.jpg') }}" style=" object-fit: cover; width:100%; height:620px">
        </div>
        <div class="" style="height:100%; width:100%; padding-top:20%; padding-left:30%">
            <div class="text">
                <div class="pb-0 mb-0"style="font-size: 15px">WELCOME</div>
                <div style="font-weight: bold; font-size: 50px">FURNITURE</div>
                <div style="font-size:20px">Find Your Favourite Furniture</div>
                <a class="btn btn-dark mt-2">Start Now</a>
            </div>
        </div>
    </div>
    <div class="" style="height:100px; width:100%;  ">
        <div class=" container" style="height:100px; width:100%; padding-top:50px; padding-left:20px">
        </div>
    </div>
    <div class=""
        style="height:1500px; width:100%; background-color:#f0f0f0; display:grid; grid-template-columns:auto 200px; ">
        <div class="container" style="height:500px; width:100%; padding-top:50px; padding-left:20px">
        
            <div class="text-white" style="font-size: 20px;">Table</div>
            <div class="row">
                <?php  foreach ($table as $item){
              ?>
                <div class="col-md-3">
                    <div class="div-menu"style="height:410px;">

                        <img src=" {{asset('storage/'.(@$item->primaryimage->image))}}" class="item"
                            style=" object-fit: cover; width:90%; height:300px; margin:10px;">
                        <div style=" height:100px;padding-left:30px; padding-right:30px">
                            <div style="font-weight:bold; text-align:center">{{ $item->name }}</div>
                            <div style="margin-top:10px">
                                <div class="bottom pt-2" style="float:left">
                                    {{ $item->price }}
                                </div>
                                <div class="btn"
                                    style="float: right; font-weight:bold; border:1px solid;background-color:#f6e690">Detail
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php  } ?>
            </div> 
        </div>

        <div>

        </div>
    </div>
@endsection
