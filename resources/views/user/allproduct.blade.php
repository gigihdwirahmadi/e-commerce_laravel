@extends('layouts.template2')
@section('title')
    All
@endsection
@section('style')
    <style>
        .yellow {

            height: 30px;
        }

        .wall {
            min-height: 100vh;
            width: 100%;
            background-color: #f0f0f0;

        }

        .hidden-navbar {
            height: 400px;
            width: 100%;
            z-index: -1;
        }

        .grid-2 {
            padding-top: 100px;
        }

        nav {
            background-color: #f9dc5c;
        }

        .banana {
            background-color: #f9dc5c;
            border: 1px solid;
            font-weight: bold;
        }
        .banana:hover {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .product-item {
            height: 360px;
            border-radius: 23px;
            background: #f0f0f0;
            box-shadow: 5px 5px 10px #cecece,
                -5px -5px 10px #ffffff;
        }

        nav {
            background-color: #f9dc5c
        }

        .btn-category {
            font-weight: bold;
        }

        .grid-filter {
            display: grid;
            grid-template-columns: 1fr 300px;
        }

        .filter-src {
            display: grid;
            grid-template-columns: 1fr 90px;
        }

        .active {
            background-color: black;
            color: #f0f0f0;
        }
        .form-control{
            border: 1px solid;
        }
        .product-item:hover{
            border: 2px solid #f9dc5c
        }
        .banana::before{
            transform: translateY(50px);
            width: 100px;
            height: 100px;
            background-color: black;
            z-index: 11;
        }
    </style>
@endsection
@section('content')
    <div class="wall">


        <div class="grid-2 container-fluid">
            <div class="grid-filter">
                <div class="filter-category">
                    <a href="{{ route('all') }}" class="btn banana btn-category" id="buttonall">All</a>
                    @foreach ($category as $c)
                        <a href="{{ route('all') }}?category={{ $c->id }}" id="button{{$c->id}}"value="{{$c->id}}"
                            class="btn banana btn-category">{{ $c->name }}</a>
                    @endforeach
                </div>
                <div class="filter-src">
                    <div>
                        <input type="text" class="form-control" placeholder="search..." id="search">
                    </div>
                    <button class="btn banana" onclick="search()">Search</button>
                </div>
            </div>
            <div class="row gx-2 gy-2 mt-1">

                @foreach ($products as $product)
                    {{-- {{dd(asset('storage/'.$product->Imageprimary->pluck('image')->toArray()))}} --}}
                    <div class="col-sm-2 product-menu" style="height:360px">
                        <div class="product-item">
                            <img src=" {{ asset('storage/' . implode(',', $product->Imageprimary->pluck('image')->toArray())) }}"
                                class="item" style=" object-fit: cover; width:90%; height:200px; margin:10px;">
                            <div class="text text-black" style="text-align: center; font-weight:bold; font-size:20px">
                                {{ $product->price }}</div>
                            <div class="text text-black" style="text-align: center;">{{ $product->name }}</div>
                            <div style="padding-left:20px;padding-right:20px; padding-top:10px">
                                <a class="btn banana"href="{{ route('detail', ['product' => $product->id]) }}"
                                    style="width:100%">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const params = new URLSearchParams(window.location.search)
       
        for (const param of params) {
            
            if (param[0] == "category") {
               var button=document.getElementById(`button${param[1]}`)
               button.classList.add("active");
               die();
            }
            
                console.log("masuk");
                var button=document.getElementById(`buttonall`)
               button.classList.add("active");
            
        }

        function search() {
            var src = document.getElementById('search').value;
            window.location.href = `{{ route('all') }}?src=${src}`;
        }
    </script>
@endsection
